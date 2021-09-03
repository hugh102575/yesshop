@extends('shop.home')


@section('css')
<link href="{{asset('css/carousel.css')}}" rel="stylesheet">
<style>
.serv ul {
  display: flex;
  flex-wrap: wrap;
  padding-left: 0;
}

.serv ul li {
  list-style: none;
  //flex: 0 0 30.333%;
}

.shop_card:hover{
    transform: scale(1.05);
}
</style>
@endsection

@php
$highlight_count=0;
foreach($user->shop->merchandise as $mmmm){
    if($mmmm->highlight==1){
        $highlight_count++;
    }
}

@endphp
@section('carousel')
@if($highlight_count!=0)
<div class="viewed pt-5 px-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="bbb_viewed_title_container">


                    <h5 class="bbb_viewed_title row text-secondary">熱門商品</h5>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>


                </div>
                <div class="bbb_viewed_slider_container py-3 ">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">

                        @foreach($user->shop->merchandise as $merc)
                        @if($merc->highlight)
                        <div class="owl-item">
                            <a class="" href="/shop/{{$user->api_token}}/{{$merc->id}}/product">
                            <div class="  bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="{{$merc->Product_Img}}" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_name">{{$merc->Product_Name}}</div>
                                    <pre class="bbb_viewed_price">${{$merc->Product_Price}}</pre>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount"><span>熱門</span></li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                            </a>
                        </div>
                        @endif
                        @endforeach

                        {{--<div class="owl-item">
                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924153/alcatel-smartphones-einsteiger-mittelklasse-neu-3m.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹12225<span>₹13300</span></div>
                                    <div class="bbb_viewed_name"><a href="#">Alkatel Phone</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924221/51_be7qfhil.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹30079</div>
                                    <div class="bbb_viewed_name"><a href="#">Samsung LED</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924241/8fbb415a2ab2a4de55bb0c8da73c4172--ps.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹22250</div>
                                    <div class="bbb_viewed_name"><a href="#">Samsung Mobile</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924275/images.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹1379</div>
                                    <div class="bbb_viewed_name"><a href="#">Huawei Power</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924361/21HmjI5eVcL.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹225<span>₹300</span></div>
                                    <div class="bbb_viewed_name"><a href="#">Sony Power</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        <div class="owl-item">
                            <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="bbb_viewed_image"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924241/8fbb415a2ab2a4de55bb0c8da73c4172--ps.jpg" alt=""></div>
                                <div class="bbb_viewed_content text-center">
                                    <div class="bbb_viewed_price">₹13275</div>
                                    <div class="bbb_viewed_name"><a href="#">Speedlink Mobile</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection



@section('stage')

<div class="card shadow">
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">商品</label>
                </div>
                <div class="form-group"><hr></div>
                <div class="serv stage_bg">
                    <ul id="display_merchandise">
                        @if(count($user->shop->merchandise)==0)
                            <label class="container-fluid">商品尚未建立</label>
                        @else
                        @endif
                    </ul>
                </div>
            </div>
        </div>


@endsection


@section('js')
<script>
    var cate_id={!! json_encode($cate_id) !!};
    var user={!! json_encode($user) !!};
    var category={!! json_encode($user->shop->category) !!};
    var merchandise={!! json_encode($user->shop->merchandise) !!};
    function show_my_merchandise(obj){
        obj.forEach(function(item,index){
            var li = document.createElement('li');
                li.setAttribute("class","my-3 searchtable");
                li.setAttribute("data-index",item.Product_Name);
            var a= document.createElement('a');
                a.setAttribute("href","/shop/"+user.api_token+"/"+item.id+"/"+"product");
                a.setAttribute("class","shop_card card shadow mx-3 ");
            var button = document.createElement('button');
                button.setAttribute("class","btn btn-link");
                button.setAttribute("type","button");
            var product_name = document.createElement('div');
                product_name.setAttribute("class","mt-3 text-dark mb-1");
                product_name.innerHTML=item.Product_Name;
            var product_img = document.createElement('img');
                product_img.setAttribute("class","p-0");
                if(item.Product_Img!=null){
                    product_img.setAttribute('src',item.Product_Img);
                }else{
                    product_img.setAttribute('src',"");
                }
                product_img.setAttribute('style',"height: 8rem; width: 8rem;");
            var product_price = document.createElement('div');
                product_price.setAttribute('class',' mt-3');
                if(item.Product_Price!=null){
                    product_price.innerHTML="<pre class='text-danger'><h5 style='display:inline;'>"+"$"+item.Product_Price+"</h5></pre>";
                }else{
                    product_price.innerHTML="";
                }


            button.appendChild(product_img);
            button.appendChild(product_name);
            button.appendChild(product_price);
            a.appendChild(button)
            li.appendChild(a)
            document.getElementById('display_merchandise').appendChild(li);



        });
    }
    function empty_zone(){
        var label=document.createElement('label');
            label.setAttribute("class","container-fluid");
            label.innerHTML="查無商品"
            document.getElementById('display_merchandise').appendChild(label);
    }

    if(document.getElementById('c_all')!=null){
        document.getElementById('c_all').classList.add('enlarge_text');
    }
    if(cate_id=='all'){
        show_my_merchandise(merchandise);
    }else{
        merchandise_filter= merchandise.filter(x => x.Product_Category==cate_id);
        if(merchandise_filter.length!=0){
            show_my_merchandise(merchandise_filter);
        }else{
            empty_zone();
        }

        var my_category=document.querySelectorAll(".my_category")
        my_category.forEach(function(item,index){
            var cate_other=document.getElementById(item.id);
            cate_other.classList.remove('enlarge_text');
            if(cate_id ==(item.id).replace("c_", "")){
                cate_other.classList.add('enlarge_text');
            }
        });
    }


    var my_category=document.querySelectorAll(".my_category")
    my_category.forEach(function(item,index){
        var cate=document.getElementById(item.id);
        cate.addEventListener("click", function() {
            my_category.forEach(function(item,index){
                var cate_other=document.getElementById(item.id);
                cate_other.classList.remove('enlarge_text');
            });
            cate.classList.add('enlarge_text');
            var c_id=(cate.id).replace("c_", "");
            let results= merchandise.filter(x => x.Product_Category==c_id);
            document.getElementById('display_merchandise').innerHTML="";
            if(c_id=='all'){
                show_my_merchandise(merchandise);
            }else{
                if(results.length!=0){
                    show_my_merchandise(results);
                }else{
                    empty_zone();
                }
            }
        })
    });




    $(document).ready(function()
{


if($('.bbb_viewed_slider').length)
{
var viewedSlider = $('.bbb_viewed_slider');

viewedSlider.owlCarousel(
{
loop:false,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:true,
responsive:
{
0:{items:1},
575:{items:2},
768:{items:3},
991:{items:4},
1199:{items:6},
1399:{items:7}
}
});

if($('.bbb_viewed_prev').length)
{
var prev = $('.bbb_viewed_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next').length)
{
var next = $('.bbb_viewed_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});
</script>

@endsection
