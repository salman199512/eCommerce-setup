@php
    $selectedAttributeGroupIds = [];
    $selectedAttributesGlobal = [];
    $existingVariants = [];

    if(isset($product)) {
        $selectedAttributeGroupIds = $product->attributes->pluck('attribute_group_id')->unique()->values()->toArray();

        // Structure: { group_id: [attr_id1, attr_id_2] }
        $selectedAttributesGlobal = $product->attributes->groupBy('attribute_group_id')->map(function($items) {
            return $items->pluck('id')->values()->toArray();
        })->toArray();

        // Prepare existing variants
        foreach($product->variants as $variant) {
             $variantAttrs = $variant->attributes->map(function($attr) {
                 return [
                     'id' => $attr->id,
                     'title' => $attr->title,
                     'group_id' => $attr->pivot->attribute_group_id
                 ];
             })->values()->toArray();

             // Sort attributes by group_id to ensure consistency if needed, though Cartesian usually keeps order.
             // For display, order doesn't strictly matter as long as validation passes.

             $existingVariants[] = [
                 'attributes' => $variantAttrs, // matches structure for data-attributes
                 'price' => $variant->price,
                 'discount' => $variant->discount,
                 'sku' => $variant->sku
             ];
        }
    }
@endphp
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' => 'Select Category']) !!}
</div>

<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Brand:') !!}
    {!! Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'placeholder' => 'Select Brand']) !!}
</div>

<!-- Sub Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category_id', 'Sub Category:') !!}
    {!! Form::select('sub_category_id', $subCategories, null, ['class' => 'form-control select2', 'placeholder' => 'Select Sub Category']) !!}
</div>

<!-- Returned Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('returned_days', 'Returned Days:') !!}
    {!! Form::number('returned_days', null, ['class' => 'form-control', 'placeholder' => 'Enter Returned Days']) !!}
</div>

<!-- Description Field -->

@include('admin.layouts.editor',
[
    'editorId' => 'description',
    'editorFieldName' => 'description',
    'editorFieldLabelName' => 'Description ',
])
<!-- Attribute Groups Selection -->
<div class="form-group col-sm-12">
    <label>Attribute Groups</label>
    {!! Form::select('attribute_groups[]', $attributeGroups, null, ['class' => 'form-control select2','multiple' => 'multiple', 'id' => 'attribute_group_selector']) !!}
</div>

<!-- Attributes Dynamic Selection Area -->
<div id="attributes_selection_area" class="col-sm-12">
    <!-- Dynamic dropdowns will be appended here -->
</div>

<!-- Variants Generation Button -->
<div class="form-group col-sm-12 mt-3">
    <button type="button" class="btn btn-primary" id="generate_variants_btn">Generate Variants</button>
</div>

<!-- Variants Table -->
<div class="col-sm-12 mt-3" id="variants_table_container" style="display: none;">
    <label>Product Variants</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Variant</th>
                <th>Price</th>
                <th>Discount (%)</th>
                <th>SKU</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="variants_table_body">
            <!-- Variant rows will be appended here -->
        </tbody>
    </table>
</div>

<!-- Images Field -->
<div class="col-sm-12">
    @include('admin.layouts.scripts.dzMultipleImageField', [
        'label' => 'Product Images',
        'elementId' => 'product_images_dropzone',
        'fieldName' => 'product_images',
        'primaryImageInputName' => 'product_images'
    ])
</div>

<div class="col-lg-12">
    <ul class="imgUl">

        @if(isset($mediaUrls) && !empty($mediaUrls))
            @foreach($mediaUrls as $row)
                @if($row['ext'] == 'jpg'
        || $row['ext'] == 'png'
        || $row['ext'] == 'jpg'
        || $row['ext'] == 'gif'
        || $row['ext'] == 'bmp'
        || $row['ext'] == 'jpeg'
        )
                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt" src="{{ $row['url'] }}">
                        </a>
                    </li>
                @elseif($row['ext'] == 'pdf')
                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt" src="{{ asset('PDF_file_icon.svg_new.png') }}">
                        </a>
                    </li>

                @elseif($row['ext'] == 'doc')

                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt"
                                 src="{{ asset('Microsoft_Office_Word_(2019–present).svg_new.png') }}">
                        </a>
                    </li>

                @elseif($row['ext'] == 'xls')
                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt"
                                 src="{{ asset('Microsoft_Office_Excel_(2019–present).svg_new.png') }}">
                        </a>
                    </li>

                @elseif($row['ext'] == 'csv')
                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt"
                                 src="{{ asset('csv-icon-1791x2048-ot22nr8i_new.png') }}">
                        </a>
                    </li>

                @else
                    <li>
                        <i class="fa fa-trash deleteImgs remove_image"
                           data-uuid="{{ $row['uuid'] }}"></i>
                        <a target="_blank" href="{{ $row['url'] }}">

                            <img class="imageAtt" src="{{ asset('file_new.png') }}">
                        </a>
                    </li>

                @endif

            @endforeach
        @endif

    </ul>
</div>
<!-- Hidden input to store variants data on submit -->
<input type="hidden" name="variants_data" id="variants_data_input">


<!-- Submit Field -->
<div class="form-group col-md-12 fields_footer_action_buttons mt-3">
    <button class="btn btn-primary rspSuccessBtns" type="submit" id="submit_btn"><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.products.index') }}" class="btn  btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
        Dropzone.autoDiscover = true;
        uploadMultipleImageByDropzone('product_images_dropzone');
        $('.select2').select2();
        $(document).ready(function() {
            // CKEditor

             // Initialize Multiple Image Dropzone
             // Logic to be added based on dzMultipleImageField expectation?
             // Assuming dropzone script initialization handled globally or via include if standard.
             // If manual init required:



            let attributeGroups = {!! json_encode($attributeGroups) !!}; // Key ID, Val Title
            let selectedAttributes = {}; // { group_id: {id, title, group_id} }

            // Edit Mode Data
            let preSelectedGroupIds = {!! json_encode($selectedAttributeGroupIds) !!};
            let preSelectedAttributes = {!! json_encode($selectedAttributesGlobal) !!};
            let preExistingVariants = {!! json_encode($existingVariants) !!};



            // Handle Attribute Group Change
            $('#attribute_group_selector').on('change', function() {
                let selectedGroupIds = $(this).val();
                fetchAttributesForGroups(selectedGroupIds);
            });

            function fetchAttributesForGroups(groupIds) {
                 if (groupIds.length === 0) {
                    $('#attributes_selection_area').empty();
                    selectedAttributes = {};
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.products.get-attributes') }}",
                    type: 'GET',
                    data: { group_ids: groupIds },
                    success: function(response) {
                        renderAttributeSelects(response, groupIds);
                    }
                });
            }

            function renderAttributeSelects(attributes, selectedGroupIds) {
                // Group attributes by group_id
                let groupedAttributes = {};
                attributes.forEach(attr => {
                    if (!groupedAttributes[attr.attribute_group_id]) groupedAttributes[attr.attribute_group_id] = [];
                    groupedAttributes[attr.attribute_group_id].push(attr);
                });

                let container = $('#attributes_selection_area');
                // Don't empty container if we are appending, but here we rebuild based on selection.
                // However, optimization: Check if group exists? simpler to rebuild for now.
                container.empty();

                selectedGroupIds.forEach(groupId => {
                     // Find group title (from selector options)
                     let groupTitle = $("#attribute_group_selector option[value='"+groupId+"']").text();
                     
                     // Check for pre-selected values
                     let preSelected = preSelectedAttributes[groupId] ? preSelectedAttributes[groupId] : [];

                     let html = `
                        <div class="form-group mt-2">
                            <label>${groupTitle} Attributes</label>
                            <select class="form-control select2 attribute-select" multiple="multiple" data-group-id="${groupId}" name="attribute_selection[${groupId}][]">
                                ${groupedAttributes[groupId] ? groupedAttributes[groupId].map(a => {
                                    let selected = preSelected.includes(a.id) ? 'selected' : '';
                                    return `<option value="${a.id}" data-title="${a.title}" ${selected}>${a.title}</option>`;
                                }).join('') : ''}
                            </select>
                        </div>
                     `;
                     container.append(html);
                });
                $('.select2').select2();
            }

            // Generate Combination Logic
            $('#generate_variants_btn').click(function() {
                let combinations = [];
                let attributeArrays = [];

                // Collect selected attributes from each dropdown
                $('.attribute-select').each(function() {
                    let groupId = $(this).data('group-id');
                    let selectedOptions = $(this).select2('data');
                    if(selectedOptions.length > 0) {
                        attributeArrays.push(selectedOptions.map(opt => ({
                            id: opt.id,
                            title: opt.text,
                            group_id: groupId
                        })));
                    }
                });

                if (attributeArrays.length === 0) {
                    alert('Please select attributes to generate variants.');
                    return;
                }

                // Cartesian Product
                combinations = cartesian(attributeArrays);
                renderVariantsTable(combinations);
            });

            function cartesian(args) {
                var r = [], max = args.length-1;
                function helper(arr, i) {
                    for (var j=0, l=args[i].length; j<l; j++) {
                        var a = arr.slice(0); // clone arr
                        a.push(args[i][j]);
                        if (i==max)
                            r.push(a);
                        else
                            helper(a, i+1);
                    }
                }
                helper([], 0);
                return r;
            }

            function renderVariantsTable(combinations) {
                let tbody = $('#variants_table_body');
                tbody.empty();
                $('#variants_table_container').show();

                combinations.forEach((combo, index) => {
                    let variantName = combo.map(c => c.title).join(' - ');
                    // Store variant attribute data as JSON string in a data attribute
                    let variantAttrData = JSON.stringify(combo);

                    let row = `
                        <tr class="variant-row" data-attributes='${variantAttrData}'>
                            <td>${variantName}</td>
                            <td><input type="number" class="form-control variant-price" step="0.01" required></td>
                            <td><input type="number" class="form-control variant-discount" step="0.01" value="0"></td>
                            <td><input type="text" class="form-control variant-sku"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-variant">X</button></td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            }

            function renderExistingVariants(variants) {
                let tbody = $('#variants_table_body');
                tbody.empty();
                $('#variants_table_container').show();

                variants.forEach((variant, index) => {
                    let combo = variant.attributes;
                    let variantName = combo.map(c => c.title).join(' - ');
                    let variantAttrData = JSON.stringify(combo);

                    let row = `
                        <tr class="variant-row" data-attributes='${variantAttrData}'>
                            <td>${variantName}</td>
                            <td><input type="number" class="form-control variant-price" step="0.01" required value="${variant.price}"></td>
                            <td><input type="number" class="form-control variant-discount" step="0.01" value="${variant.discount || 0}"></td>
                            <td><input type="text" class="form-control variant-sku" value="${variant.sku || ''}"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-variant">X</button></td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            }

            $(document).on('click', '.remove-variant', function() {
                $(this).closest('tr').remove();
            });

            // Form Submit Logic
            $('.submitsByAjax').submit(function (e) {
                e.preventDefault();

                // Collect Variant Data
                let variants = [];
                $('.variant-row').each(function() {
                    let row = $(this);
                    variants.push({
                        attributes: row.data('attributes'),
                        price: row.find('.variant-price').val(),
                        discount: row.find('.variant-discount').val(),
                        sku: row.find('.variant-sku').val()
                    });
                });

                if (variants.length === 0) {
                    alert('Please generate at least one variant.');
                    return;
                }

                $('#variants_data_input').val(JSON.stringify(variants));

                 // Update CKEditor content to textarea
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                let type = '{{ $type ?? '' }}'
                let dataToPass = new FormData($(this)[0]);

                ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                    type === 'create' ? postCreate : undefined);
            });

            function postCreate(){
                switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
            }

            // Initialize Edit Mode (Must be after listeners are attached)
            if(preSelectedGroupIds.length > 0) {
                $('#attribute_group_selector').val(preSelectedGroupIds).trigger('change');
            }
            
            if(preExistingVariants.length > 0) {
                renderExistingVariants(preExistingVariants);
            }
        });
    </script>
@endpush
