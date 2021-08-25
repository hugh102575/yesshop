@extends('shop.home')


@section('css')
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
.stage_bg
{background-color: #f0f0f0;}

</style>
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
                li.setAttribute("class","my-3");
            var a= document.createElement('a');
                a.setAttribute("href","/shop/"+user.api_token+"/"+item.id+"/"+"product");
                a.setAttribute("class","card shadow mx-3");
            var button = document.createElement('button');
                button.setAttribute("class","btn btn-link");
                button.setAttribute("type","button");
            var product_name = document.createElement('div');
                product_name.setAttribute("class","mt-3 text-dark mb-1");
                product_name.innerHTML=item.Product_Name;
            var product_img = document.createElement('img');
                if(item.Product_Img!=null){
                    product_img.setAttribute('src',item.Product_Img);
                }else{
                    product_img.setAttribute('src',"");
                }
                product_img.setAttribute('style',"height: 10rem; width: 10rem;");
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


</script>
@endsection
