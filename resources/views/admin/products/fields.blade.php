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
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'id' => 'master_title']) !!}
</div>

{!! Form::hidden('slug', null, ['id' => 'master_slug']) !!}

<!-- Meta Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_title', 'Meta Title:') !!}
    {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title', 'id' => 'master_meta_title']) !!}
</div>

<!-- Meta Keywords Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_keywords', 'Meta Keywords:') !!}
    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Keywords', 'rows' => 2]) !!}
</div>

<!-- Meta Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'rows' => 2]) !!}
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

@include('admin.layouts.editor',
[
    'editorId' => 'logistics_care',
    'editorFieldName' => 'logistics_care',
    'editorFieldLabelName' => 'Logistics & Care ',
])

<!-- Is Tax Included Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_tax_included', 'Is Tax Included:') !!}
    <div class="form-check">
        {!! Form::hidden('is_tax_included', 0) !!}
        {!! Form::checkbox('is_tax_included', 1, null, ['class' => 'form-check-input', 'data-bootstrap-switch']) !!}
    </div>
</div>
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

<div class="col-lg-12 mt-4">
    <div class="row">
        @if(isset($mediaUrls) && !empty($mediaUrls))
            @foreach($mediaUrls as $row)
                <div class="col-sm-3 mb-3 text-center position-relative image-container-item" id="media-item-{{ $row['uuid'] }}">
                    <div class="border rounded p-2 h-100 shadow-sm d-flex flex-column align-items-center justify-content-center bg-light position-relative">
                        
                        <!-- Delete Icon -->
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm p-1 position-absolute top-0 end-0 m-2 rounded-circle shadow-sm deleteImgs remove_image_btn" data-uuid="{{ $row['uuid'] }}" title="Delete Image" style="z-index: 10; display: flex; align-items: center; justify-content: center; width: 30px; height: 30px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>

                        <a target="_blank" href="{{ $row['url'] }}" class="d-block w-100" style="height: 150px; overflow: hidden;">
                            @if(in_array(strtolower($row['ext']), ['jpg', 'png', 'jpeg', 'gif', 'bmp', 'webp']))
                                <img src="{{ $row['url'] }}" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 100%;" alt="Product Image">
                            @elseif($row['ext'] == 'pdf')
                                <img src="{{ asset('PDF_file_icon.svg_new.png') }}" class="img-fluid" style="max-height: 100px; margin-top: 25px;">
                            @elseif($row['ext'] == 'doc' || $row['ext'] == 'docx')
                                <img src="{{ asset('Microsoft_Office_Word_(2019–present).svg_new.png') }}" class="img-fluid" style="max-height: 100px; margin-top: 25px;">
                            @elseif($row['ext'] == 'xls' || $row['ext'] == 'xlsx')
                                <img src="{{ asset('Microsoft_Office_Excel_(2019–present).svg_new.png') }}" class="img-fluid" style="max-height: 100px; margin-top: 25px;">
                            @elseif($row['ext'] == 'csv')
                                <img src="{{ asset('csv-icon-1791x2048-ot22nr8i_new.png') }}" class="img-fluid" style="max-height: 100px; margin-top: 25px;">
                            @else
                                <img src="{{ asset('file_new.png') }}" class="img-fluid" style="max-height: 100px; margin-top: 25px;">
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- Hidden input to store variants data on submit -->
<input type="hidden" name="variants_data" id="variants_data_input">


<!-- Submit Field -->
<div class="form-group col-md-12 fields_footer_action_buttons mt-3">
    <button class="btn btn-primary rspSuccessBtns" type="submit" id="submit_btn"><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.products.index') }}" class="btn  btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css" />
@endpush

@push('stackedScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
        Dropzone.autoDiscover = true;
        uploadMultipleImageByDropzone('product_images_dropzone');
        $('.select2').select2();
        $(document).ready(function() {
            // Auto generate slug and meta title
            $('#master_title').on('input', function() {
                let title = $(this).val();
                let slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#master_slug').val(slug);
                $('#master_meta_title').val(title);
            });

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
            $(document).on('click', '.remove_image_btn', function(e) {
                e.preventDefault();
                let uuid = $(this).data('uuid');
                let element = $('#media-item-' + uuid);

                console.log("Delete clicked for uuid:", uuid); // Debugging

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this image!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log("Confirmed delete for uuid:", uuid); // Debugging
                        $.ajax({
                            url: "{{ route('file.remove') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                mediaUuid: uuid
                            },
                            success: function(response) {
                                console.log("AJAX Success:", response); // Debugging
                                if (response.status) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Image has been deleted.',
                                        'success'
                                    );
                                    element.remove();
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        'Failed to delete image.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                console.error("AJAX Error:", xhr); // Debugging
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
