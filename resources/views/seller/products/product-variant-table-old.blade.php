<table id="datatables" class="table table-no-bordered col-md-offset-1 col-lg-10" cellspacing="0" style="width:80%">
    <tr>
        <th class="text-center">SKU</th>
        <th class="text-center">Name</th>
        <th class="text-center">Volume</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Price</th>
        <th class="text-center">Image</th>
    </tr>
    <tbody>
    @php $i = 0 @endphp
    @foreach ($volumes as $volume)
        <tr>
            <td class="text-center">
                <p>{{ substr(Auth::user()->first_name, 0, 2) }}{{ substr($product->name, 0, 2) }}{{ $volume->volume }}</p>
                <input type="hidden" class="form-control text-center" name="sku[{{ $i }}]"
                       value="{{ substr(Auth::user()->first_name, 0, 2) }}{{ substr($product->name, 0, 2) }}{{ $volume->volume }}"
                       required>
            </td>
            <td class="text-center">
                <input type="text" class="form-control text-center" name="name[{{ $i }}]" required
                       value="{{ $product->name }} {{$volume->quantity}}x{{ $volume->volume }}ml">
            </td>
            <td class="text-center">
                <p>{{ $volume->volume }}ml</p>
                <input type="hidden" name="volume_id[{{ $i }}]" required value="{{ $volume->id }}">
            </td>
            <td class="text-center">
                <p>{{ $volume->quantity }}</p>
                <input type="hidden" class="form-control text-center" name="quantity[{{ $i }}]" required
                       value="{{ $volume->quantity }}">
            </td>
            <td class="text-center">
                <input type="text" class="form-control text-center" name="price[{{ $i }}]" required value=""
                       placeholder="Price">
            </td>
            <td class="text-center">
                @if ($volume->image)
                    <img class="thumbnail img-responsive"
                         src="{{URL::asset($volume->image) }}"
                         alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                    />
                @else
                    <div class="input-group col-md-12">
                        <div class="form-group">
                            <div class="form-group is-empty is-fileinput">
                                <input type="file" name="images[{{ $i }}]">
                                <div class="input-group col-md-12">
                                <span class="input-group-addon">
                                    <i class="material-icons">image</i>
                                </span>
                                    <input type="text" readonly="" class="form-control" placeholder="Image (Max: 2mb)">
                                    <span class="input-group-btn input-group-sm">
                                    <button type="button" class="btn btn-fab btn-fab-mini">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </td>
        </tr>
        @php $i++ @endphp
    @endforeach
    </tbody>
</table>
