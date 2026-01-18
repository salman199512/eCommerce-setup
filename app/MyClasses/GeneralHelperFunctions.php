<?php

/**
 * Author: Nikhil Bhatia
 * TimeStamp: 2020-04-28 17:02 IST
 */

namespace App\MyClasses;


use App\Models\Clientele;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Task;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GeneralHelperFunctions {

    /**
     * Updates or Creates Single Media files like avatar for models.
     *
     * @param Model $modelRecord
     * @param Request $request
     * @param string $inputFileName
     * @param string $collection
     * @param string $defaultMediaPath
     * @param bool $isDefaultMediaPathUrl
     * @return Media | bool
     */
    public static function updateOrCreate_singleMedia(Model $modelRecord, Request $request, $inputFileName = 'avatar', $collection = 'avatar', $defaultMediaPath = null, $isDefaultMediaPathUrl = false){
        if($request->hasFile($inputFileName)) {
            $hashedName = $request->file($inputFileName)->hashName();
            return $modelRecord->addMedia($request->{$inputFileName})
                ->setName($hashedName)
                ->setFileName($hashedName)
                ->withResponsiveImages()
                ->toMediaCollection($collection);
        }

        if(is_null($defaultMediaPath)) {
            if ($request->has($inputFileName . 'Deleted') && (int)$request->input($inputFileName . 'Deleted')) {
                $modelRecord->clearMediaCollection($collection);
            }
        }else{
            if(($request->has($inputFileName . 'Deleted') && $request->boolean($inputFileName . 'Deleted'))
                || ($request->has('provideDefault' . Str::ucfirst($inputFileName)) && $request->boolean('provideDefault' . Str::ucfirst($inputFileName)))){
                return self::updateOrCreate_defaultMedia($modelRecord, $defaultMediaPath, $collection, $isDefaultMediaPathUrl);
            }
        }

        return true;
    }

    /**
     * Updates or Creates Single Media via DropZone.
     * @param Model $model
     * @param $uploadedMediaUuid
     * @param string $collection
     * @param null $defaultMediaPath
     * @param bool $isMediaUrl
     * @return bool|Media
     */
    public static function updateOrCreate_singleMedia_viaDropZone(Model $model, $uploadedMediaUuid, $defaultMediaPath = null,
                                                                  $collection = 'avatar', $isMediaUrl = true) {
        if(!empty($uploadedMediaUuid)) {
            $uploadedMedia = Media::findByUuid($uploadedMediaUuid);
            if(!empty($uploadedMedia)) {
                return $uploadedMedia->move($model, $collection);
            }
        }
        if(is_null($defaultMediaPath)) {
            $model->clearMediaCollection($collection);
        } else {
            if(!$model->hasMedia($collection)){
                return self::updateOrCreate_defaultMedia($model, $defaultMediaPath, $collection, $isMediaUrl);
            }
        }
        return true;
    }


    /**
     * Sets Default Media to Single Media Collection
     *
     * @param Model $modelRecord
     * @param string $defaultMediaPath
     * @param string $collection
     * @param bool $isMediaUrl
     * @return Media
     */
    public static function updateOrCreate_defaultMedia(Model $modelRecord, $defaultMediaPath, $collection, $isMediaUrl = false) {
        if(!$isMediaUrl) {
            $file = $defaultMediaPath;
            $pathInfo = pathinfo($file);
            $hashedName = md5($pathInfo['filename']) . '.' . $pathInfo['extension'];
            return $modelRecord->copyMedia($file)
                ->setName($hashedName)
                ->setFileName($hashedName)
                ->withResponsiveImages()
                ->toMediaCollection($collection);
        }

        return $modelRecord->addMediaFromUrl($defaultMediaPath)
            ->withResponsiveImages()
            ->toMediaCollection($collection);
    }



    /**
     * Returns basic Single Media Urls for Models of thumb_100x100, thumb_250x250 and NoC
     *
     * @param Model $modelRecord
     * @param $model
     * @param string $collection
     * @return mixed
     */
    public static function getSingleMediaUrls(Model $modelRecord, $model, string $collection = 'avatar', string $routePrefix = '',
                                                    $conversionMaps = null, array $additionalRouteParams = [], $putFallbackAsNull = false)
    {
        if (is_null($conversionMaps)) $conversionMaps = self::getDefaultConversionsMapForSingleMediaUrls();
        if (!is_null($collection) && $modelRecord->hasMedia($collection)) {
            /** @var Media $avatar */
            $avatar = $modelRecord->getFirstMedia($collection);
            $avatarUrl = [];
            foreach ($conversionMaps as $conversionSize => $conversionMap) {
                if (!$avatar->hasGeneratedConversion($conversionMap[0]) && $conversionMap[0] != "NoC") continue;

                $avatarUrl[$conversionSize] = $conversionMap[0] == 'NoC' ? $avatar->getFullUrl() : $avatar->getFullUrl($conversionMap[0]);
                // $avatarUrl[$conversionSize] = '';
            }
        } else {
            foreach ($conversionMaps as $conversionSize => $conversionMap) {
                if ($putFallbackAsNull) {
                    $avatarUrl[$conversionSize] = "";
                } else {
                    $avatarUrl[$conversionSize] = route($routePrefix . 'images_default', ['resolution' => $conversionMap[1], 'type' => '404']);
                }
            }
        }
        return $avatarUrl;
    }

    public static function getDefaultConversionsMapForSingleMediaUrls()
    {
        return [
            'blur' => ['thumb_blur', '100x100'],
            '100' => ['thumb_100x100', '100x100'],
            '250' => ['thumb_250x250', '250x250'],
            'NoC' => ['NoC', '1024x1024'],
        ];
    }

    /**
     * Generates SEO for given information
     *
     * @param null $title
     * @param null $description
     * @param array $images
     * @param array $keywords
     * @param null $url
     * @param null $canonicalUrl
     * @param array $properties
     */
    public static function setSeo($title = null, $description = null, $images = [], $keywords = [], $url = null, $canonicalUrl = null, $properties = []) {
        if(!is_null($title) && !empty($title))    SEOTools::setTitle("$title");
        if(!is_null($description) && !empty($description))    SEOTools::setDescription($description);
        if(!is_null($url)  && !empty($url))    SEOTools::opengraph()->setUrl($url);
        if(!is_null($canonicalUrl)  && !empty($canonicalUrl))    SEOTools::setCanonical($canonicalUrl);
        if(!is_null($properties)  && !empty($properties) && sizeof($properties) > 0){
            foreach ($properties as $key => $value) {
                SEOTools::opengraph()->addProperty($key, $value);
            }
        }
        if(!is_null($images) && !empty($images) && sizeof($images) > 0){
            SEOTools::opengraph()->addImage($images[0]);
            foreach ($images as $keyword) {
                SEOTools::jsonLd()->addImage($keyword);
            }
        }
        if(!is_null($keywords) && !empty($keywords) && sizeof($keywords) > 0){
            foreach ($keywords as $keyword) {
                SEOTools::metatags()->addKeyword($keyword);
            }
        }
    }

    public static function applyCategoryRelationFilterOnQuery_fromRequest(Builder $QUERY, Request $request) {
        if(request()->has('category') && !empty(request()->input('category'))) {
            $QUERY->whereHas('category', function ($QUERY) {
                $QUERY->where('uuid', request()->input('category'));
            });
        }
        if(request()->has('url_category') && !empty(request()->input('url_category'))) {
            $QUERY->whereHas('category', function ($QUERY) {
                $QUERY->where('uuid', request()->input('url_category'));
            });
        }
        return $QUERY;
    }


    /**
     * Adds all attachment files to the media library.
     * @param Model $record
     * @param Request $request
     * @param $requestInputName
     * @param $collectionName
     */
    public static function addFilesFromRequest_toMediaCollection_ofModel(Model $record, Request $request, $requestInputName, $collectionName) {
        if($request->hasFile($requestInputName)){
            foreach ($request->file($requestInputName) as $file) {
                $record->addMedia($file)
                    ->toMediaCollection($collectionName);
            }
        }
    }


    /**
     * Returns HTML for Editing created record or registering another
     * @param $record
     * @param null $editRoute
     * @param string $nameField
     * @param null $editText
     * @param string $regAnotherText
     * @return string
     */
    public static function getSuccessResponseBtn($record = null,$editRoute = null,$nameField = 'name', $editText = null, $regAnotherText = 'Register Another?'){
        $regAnotherBtnHtml = '';
        $editBtnHtml = '';
        if(!is_null($record)) {
            if (!is_null($editRoute)) {
                $editText = !is_null($editText) ? $editText : (!is_null($nameField) ? 'Edit ' . $record->{$nameField} : 'Edit');
                $editBtnHtml = "<a href='" . $editRoute . "' class='btn btn-secondary m-t-5 rspSuccessBtns' role='button'>" . $editText . "</a>";
            }
        }
        if(!is_null($regAnotherText)) {
            $regAnotherBtnHtml = "<button type='button' class='btn m-t-5 btn-primary rspSuccessBtns' onclick='switch_between_register_to_registerAnother_btn($(\".submitsByAjax\"), true)'>$regAnotherText</button>";
        }
        return "<hr class='m-t-5 m-b-5'>
                <div>
                    $editBtnHtml
                    $regAnotherBtnHtml
                </div>";
    }


    /**
     * Returns model's id from given uuid and builder for the model
     * @param Builder $builder
     * @param $uuid
     * @return int |null
     */
    public static function getModelIdFromUuid(Builder $builder, $uuid) {
        $record = $builder->whereUuid($uuid)->first();
        return $record ? $record->id : null;
    }

    //=======   Mails/SMS transaction ==========

    /**
     * Returns table name of mailable/messagable
     * @return string
     */
    public static function getTransactionableTableName() {
        return Str::plural(request()->route('type'));
    }

    /**
     * Gets the query instance for the mailable/messagable/commentable.
     * @param string $returnType => query or class
     * @return Clientele|Lead|\Illuminate\Database\Eloquent\Builder|string|null
     */
    public static function getTransactionableQueryOrInstance_forRequest($returnType = 'query') {
        switch (request()->route('type')){
            case 'lead' : return $returnType == 'query' ? Lead::query() : Lead::class;
            case 'clientele' : return $returnType == 'query' ? Clientele::query() : Clientele::class;
            case 'task' : return $returnType == 'query' ? Task::query() : Task::class;
            case 'project' : return $returnType == 'query' ? Project::query() : Project::class;
            default: return null;
        }
    }

    /**
     * Applies pagination to the query
     * @param Request $request
     * @param Builder $QUERY
     * @return mixed
     */
    public static function applyPaginationToTheQuery(Request $request, $QUERY) {
        if(isset($request->pageNo) && isset($request->noOfRecords) && !empty($request->pageNo) && !empty($request->noOfRecords)) {
            $skip = (int)(($request->pageNo - 1) * $request->noOfRecords);
            $QUERY->skip((int)$skip)->limit((int)$request->noOfRecords);
        }
        return $QUERY;
    }


    /**
     * A certain format is required for select with default listing, this format is built by this function.
     * @param $results
     * @param $term
     * @param $totalRecordCount
     * @param Request|null $request
     * @param $paginateForSearch
     * @return array
     */
    public static function prepareSelect2Response_forDefaultListing($results, $term, $totalRecordCount, Request $request = null, $paginateForSearch = false) {
        $request = $request ?? request();
        $response = [
            'results' => $results,
        ];
        if($term == '' || $paginateForSearch){
            $response['pagination'] = [
                'more' => $request->input('pageNo') * $request->input('noOfRecords') < $totalRecordCount
            ];
        }
        return $response;
    }


    /**
     * Prepares Date time string from the request when date and time are separately provided in the request.
     * @param Request $request
     * @param $dateVarName
     * @param $timeVarName
     * @param string $dateFormat
     * @param string $timeFormat
     * @return string|null
     */
    public static function prepareDateTimeString_fromReq(Request $request, $dateVarName, $timeVarName = null,
                                                         $dateFormat = 'd/m/Y', $timeFormat = 'H:i') {
        $dateTimeString = '';
        if($request->has($dateVarName) && !empty($request->input($dateVarName)) && !is_null($request->input($dateVarName))){
            $dateTimeString .= Carbon::createFromFormat($dateFormat, $request->input($dateVarName))->toDateString();
            if(!is_null($timeVarName) && $request->has($timeVarName) && !empty($request->input($timeVarName)) && !is_null($request->input($timeVarName))){
                $dateTimeString .= ' ' . Carbon::createFromFormat($timeFormat, $request->input($timeVarName))->toTimeString();
            }
        }

        return $dateTimeString == '' ? null : $dateTimeString;
    }


    /**
     * Deletes Model records one by one, so that their delete event is triggered.
     * @param $recordsToDelete
     */
    public static function deleteModelRecordsOneByOne($recordsToDelete) {
        foreach ($recordsToDelete as $item) {
            $item->delete();
        }
    }

    /**
     * Counts Sundays between dates.
     * @param $start
     * @param $end
     * @return int
     */
    public static function countSundaysBetweenDates($start, $end) {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        return $start->diffInDaysFiltered(function (Carbon $date) {
            return $date->isSunday();
        }, $end);
    }

    /**
     * Calculates the change in percentage over two values.
     * @param $new
     * @param $old
     * @return string
     */
    public static function calculateChangePercentage($new, $old) {
        if($old == 0)   return $new * 100;
        return round((($new-$old)/$old), 2) * 100;
    }

    /**
     * Prepares HTML date, such that, displaying text is shorter text, while title is detailed text.
     * @param $date
     * @param string $format
     * @return string
     */
    public static function prepareHtmlDate($date, $format = 'Y-m-d H:i:s') {
        if(is_null($date))  return '';
        try {
            $date = Carbon::parse($date);
        }catch (InvalidFormatException $e){
            $date = Carbon::createFromFormat($format, $date);
        }
        return '<p title="' . $date->toDayDateTimeString() . '">' . $date->format('F d, Y') . '</p>';
    }

    /**
     * Checks if the input is valid uuid.
     * @param $uuid
     * @return bool
     */
    public static function is_uuid($uuid) {
        if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid) !== 1)) {
            return false;
        }
        return true;
    }

    public static function getRulesForArrFilterInputs($rules, $keyName, $required = false, $includeFilterTypes = true) {
        return [
            $keyName => ($required ? 'required' : 'nullable') . '|array',
            "$keyName.*" => ($required ? 'required' : 'nullable') . '|' . $rules,
            "{$keyName}_type" => 'nullable|in:In,NotIn',
        ];
    }

    /**
     * Gets ordinal of given number. like 1st, 2nd, 3rd
     * @param $number
     * @return string
     */
    public static function getOrdinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

    public static function getSetting($field){
        if($field != ''){
            $setting =  Setting::where('id', '1')->first();
            if($field != 'image'){
                return $setting->$field ?? '';
            }else{
                $hasAvatar = !empty($setting) ? $setting->hasMedia('avatar') : false;
                return $hasAvatar ? $setting->avatarUrl['250'] : route('images_default',['resolution' => '250x250']);
            }

        }

    }

    public static function getLang(){
        $locale = app()->getLocale();
        $localeToFieldMap = [
            'en' => 'English',  // English
            'hi' => 'Hindi',    // Hindi
            'gu' => 'Gujarati', // Gujarati
            // Add more mappings if you add more languages in the future
        ];

        $language = $localeToFieldMap[$locale] ?? 'English';
        return $language;
    }


    public static function sendNotification($token, $title, $notification, $img)
    {
        $projectId = 'gtalk-c8994'; // Firebase project ID
        $json = '{
                      "type": "service_account",
                      "project_id": "gtalk-c8994",
                      "private_key_id": "28fbe9328d4b9ee8b1f58781ec77eb11e57e1a8d",
                      "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCjf9aFNvqRSYA9\nqvgI4gz+kbYqzEFAWVPEkrmsrfP6ccbW605QJjGf6+ON/IhXNosxvDX0t0bekoyc\n8PFrMe0QVl7FrAOBIXV/OMIBlvMjKoAWKouvOLbyQZdE8fAEu0Y2FkT+FI41D82x\n4FGvhB/nQ3VbJuIQdpAdhAM31CeaMcb0YfBQM5jv2WXtAuoBsgTRUh0/QzlvoOc0\nqqIU1H+NhiVDwKxuoZlA1U/2zFfTC9U5MWNL9JdhIz2YQlLR+Z3iTsAD3SaS06a+\nyw6lT3BgeNr4fYWRGHwW/jG0V3bTwnLTHQzX9EfEjzhZ0DaQs5tePh6QluHM2aKx\nh6BRtUunAgMBAAECggEAHvlHawo80sxRWp1qishEPO/eymHSlL23dFx1h2SW/WGT\nkUCXn/B0Yz79Z3cpXxhKq1vj/t2/s8egktTEb5HQPtGV9628Jjjv+O+INWPi4M0a\n4dgiiUndwqwxW5LX7RWLWhDC9j1vqVa6mZGM+Aq4PogVkfSeTA8iAy1wrKFo9Tle\nGbiSps2frf42tKVLeLPNG+BK82gf0ET6tXGRi14BZIgr8p1m+sdA0WLokEYbVf52\nKDGAdOGEDsJRQTx5L5s3ol3lvg6YyqrWT6P2kyMT+6umbWwR5QXb2za6e9vv6VZY\nvSeWJp+5r7ZHduxzGGQ/wg84LkNxvo4Zmf8Ujt4ZXQKBgQDd2td03a+4APCDt5bB\nsjwy632L4v3DvojSpRGoX+CbykyZQ4dQbJbUp+Sq0gNIRqBb4ug7LU+vxhOVICZq\nK+klAZKrK+Pk/rHPw7RQo0+WzmNKZ0eDR3o0WyllBGOoyZRo9T83+wEr/AKydKEz\nBJ8m4LrT8pyDTJvuEcH5Ce8XVQKBgQC8qcUdttJOCc9VBTQ8OpEyL8inQ7EEJz9X\nD17EYu2ArOSF9Be3iKFcEyrFrWVIAJf3rd0D53edkO3nY1x4PY6V8GzmlcH/1AoQ\n6VRznGozw9isdBYNe2Nky5Uso0iLgXKGNjwJAVMlsTqmba+OAngljYt+N6weUBPN\nwdThNiwfCwKBgGdW66ttI8+i6GWCW7/HxRC27pj9V9UY6GSuLSZv2pDWz41Ijjwh\nCLTvq60B/DNraoDClggSmB65Nh/thNdJsuTg8a+31wSwuqSbdV9mYslNQ6TBrOby\noXLHz+VVARL7Kp0lN5hc2/PgBGWZvAimq3eRkJTvWoYyZiOjs+XMAcmtAoGBAJx8\nGHKADMoL2vwDOANo9Lvy5HTQccgnIaN9rTYpdCPRxC7TesSRwH1VrJmQLDzfuS0H\n+hVd7Vo1Nw9A3Bcjv9vgMwPDXclrv/ms/45xQ6myHUtVcmE2Ygfd0NrYiLil4y8t\nVviFL8lIyoP24LFinPNRB03msY3nD7YPuxoeS9RnAoGBAMCZienr4BJ0LyR7+ZZP\ncxezZ5+bcYpBKmcK2HIgIXKPi9jFOJq6deSdNlRyGdFwINgpaRA8twniIa2ACtSs\nA515KJxijIxq6wM3Esw9GjTyjgeLy5xR7uyQp0O6bTw/emvWGCNEW0qX2maXKAAJ\n6GgQsY47OQDE2XzYntopRwMx\n-----END PRIVATE KEY-----\n",
                      "client_email": "firebase-adminsdk-fbsvc@gtalk-c8994.iam.gserviceaccount.com",
                      "client_id": "107307210928177282437",
                      "auth_uri": "https://accounts.google.com/o/oauth2/auth",
                      "token_uri": "https://oauth2.googleapis.com/token",
                      "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
                      "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40gtalk-c8994.iam.gserviceaccount.com",
                      "universe_domain": "googleapis.com"
                    }';
        $serviceAccount = json_decode(($json), true);

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $messagePayload = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $notification,
                    'image' => $img
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => 'default',
                        ],
                    ],
                ],
            ],
        ];

        $accessToken = self::getAccessToken($serviceAccount);


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messagePayload));

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus === 200) {
            return true;
        } else {
            return false;
        }
    }

    public static function number_format_short($n)
    {
        $n = (int) $n;
        if ($n >= 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'K';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'M';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'B';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 'T';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }

    private static function getAccessToken($serviceAccount)
    {
        $header = base64_encode(json_encode([
            'alg' => 'RS256',
            'typ' => 'JWT'
        ]));

        $iat = time();
        $exp = $iat + 3600; // Token is valid for 1 hour

        $claimSet = base64_encode(json_encode([
            'iss' => $serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $exp,
            'iat' => $iat,
        ]));

        $signatureData = $header . '.' . $claimSet;
        $privateKey = $serviceAccount['private_key'];

        openssl_sign($signatureData, $signature, $privateKey, 'SHA256');
        $jwt = $signatureData . '.' . base64_encode($signature);

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]));

        $response = curl_exec($ch);
        $responseDecoded = json_decode($response, true);
        curl_close($ch);

        return $responseDecoded['access_token'] ?? null;
    }
    public static function checkSession(Request $request)
    {
        $user_id = '';
        if ($request->hasCookie('user_id')) {
            $user_id = $request->cookie('user_id');
        }
        return $user_id;
    }
}
