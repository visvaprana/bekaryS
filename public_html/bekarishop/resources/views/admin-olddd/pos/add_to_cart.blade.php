<table class="table table-striped cart-list">
    <thead>
        <tr>
            <th>
                Product
            </th>
            <th>
                Unit
            </th>
            <th>
                Price
            </th>
            <th>
                Quantity <br> ( 500 Gram = 0.5 kg )
            </th>
            <th>
                Subtotal
            </th>
            <th>
                Delete
            </th>
        </tr>
    </thead>
    <tbody class="">




        @foreach ($contents as $content)
            @if ($content->rowId)
                <input type="hidden" name="rowid[]" value="{{ $content->rowId }}">
            @endif

            <?php
            $product = App\Models\Product::where('id', $content->id)->first();
            if ($product) {
                $product_unit = App\Models\ProductUnit::where('product_id', $product->id)->first();
            }
            
            ?>

            <tr class="">

                <td>
                    <span class="item_cart">{{ $content->name }}</span>
                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                </td>
                <td>
                    <span class="item_cart">{{ $product_unit->unit->name ?? '' }}</span>
                </td>
                <td>
                    <strong>৳<span class="cart_unit_price">{{ $content->price }}</span></strong>
                </td>

                <td>
                    <div class="numbers-row">
                        <input type="text" id="" class="qty2" name="quantity[]"
                            data-id="{{ $content->rowId }}" value="{{ $content->qty }}" min="1"
                            onkeyup="updateCart(this)" style="width: 90px">
                    </div>
                </td>
                <td>
                    <strong>৳ <span class="cart_sub_total">{{ $content->price * $content->qty }}</span> </strong>
                </td>
                <td class="options">
                    <a href="{{ route('admin/remove_from_cart_admin', $content->rowId) }}"><img
                            src="{{ asset('assets/frontend/') }}/css/SVG/close.svg" alt=""></a>

                    {{-- <a href="#" class="DeleteCartItem" data-id="{{$content->rowId}}"><img src="{{ asset('assets/frontend/') }}/css/SVG/close.svg" alt=""></a> --}}
                </td>

            </tr>
        @endforeach





    </tbody>
    <tfoot>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3">
                <?php
                $totalPrice = $sub_total;
                ?>
                <span>Total:</span> <br> <input type="text" name="total" class="total"
                    value="{{ floatval($totalPrice) }}" readonly>
            </td>

        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">
                <?php
                $totalPrice = $sub_total;
                ?>
                <span>Pay:</span> <br> <input type="text" name="pay" class="pay" value=""
                    onkeyup="calculateRetun(this.value)" required>
            </td>

        </tr>


        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">
                <?php
                $totalPrice = $sub_total;
                ?>
                <span>Return:</span> <br> <input type="text" name="return" class="return" value="" required>
            </td>

        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">

                <span>Payment Method:</span><br>
                <select name="payment_method_id" id="" required>
                    <!--<option value="">Select</option>-->

                    @foreach ($payment_methods as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </td>

        </tr>



    </tfoot>
</table>
