                <div class=" col-6 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <div class="card-images">
                            <img src="{{ asset($product->product_image_small) }}" class="card-img-top" alt="{{$product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="d-flex justify-content-between card-price-btn">
                            <h6 class="card-text d-inline-block">
                                Price
                                
                                @if($product->discount_price > 0)
                                
                                   ৳ {{ $product->discount_price }}
                                   
                                @else
                                    
                                    ৳{{ $product->sell_price }}
                                
                                @endif
        
                                @if ($product->discount_price > 0)
                                    <span class="old_price">৳{{ $product->sell_price ?? '' }}</span>
                                @endif
                                
                                
                            </h6>
                            
                            
                            
                            <button class="add_cart AddCart" data-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>