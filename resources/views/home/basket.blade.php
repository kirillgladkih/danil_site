@extends('app')

@section('title')Вкусняшки от Торяшки@endsection

@section('styles')
<link rel="shortcut icon" href="{{ asset('images/sloi_1.png') }}" type='img'>    
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')

    <div class="modal fade" id='contactsModal' tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Введите контактные данные</h5>
            
          </div>
        <div class="modal-body">
            <div class="from-group mb-4">
                <input type="text" class="form-control" placeholder="Имя" id='name'>
            </div>
            <div class="from-group">
                <input type="text" class="form-control" placeholder="89008080600" id='phone'>
            </div>
            <div class="from-group">
                <h5 class="text-center main-sum mt-3 mb-3"></h5>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
          <button type="button" class="btn btn-primary save">Оформить </button>
        </div>
      </div>
    </div>
  </div>

<h1 class="text-center mb-3" style="color: #a54c22;">Корзина</h1>

<h1 class="text-center" style="color: #a54c22;">
    <button class="btn btn-danger basket" 
    style="padding: 1.25em 2em;"
    data-toggle="modal" data-target='#contactsModal'>Оформить заказ</button>
</h1>
<div class="products justify-content-center d-flex flex-column flex-md-row pt-4 pb-4">
    @foreach ($data as $item)
        <div class="product_item col-12 col-md-4" id='item-{{ $item->id }}'>
            <div class="product-img">
                <img src="{{ asset($item->img_path) }}">
            </div>
            <div class="product_about text-center pt-4">
                <h5>{{ $item->name }}</h5>
                    <p class="product-price">Цена: {{ $item->price }} Руб.</p>
                    <p class="product-price sum sum-{{ $item->id }}">Сумма: {{ $item->price*$item->count }} Руб.</p>
                        <div class="form-group d-flex justify-content-center">
                            <label class="pr-3 pt-1">Кол-во:</label>
                            <input min='1' type="number" class="form-control col-4 count" 
                            value="{{ $item->count }}" data-price='{{ $item->price }}'
                            data-sum="sum-{{ $item->id }}" data-id="{{ $item->id }}">
                        </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-del" style="padding: 1.25em 2em;" value="{{ $item->id }}">Удалить товар</button>
                    </div>
            </div>    
        </div>
    @endforeach
</div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('scripts')

<script>
    $(document).ready(function(){

        let products = $('.products')[0].children.length;
        
        let url = location.href;

        if(products == 0 ){
            alert('Сначала добавьте товары в корзину!');
            window.location.href = url.replace(/basket/, 'shop');
        }

        $('.count').change(function(){

            let replace_class = '.' + $(this)[0].dataset.sum;
            let price         = '.' + $(this)[0].dataset.price;
            let count         = $(this).val();

            $(replace_class).text("Сумма: " + Math.round(price * count * 1000) + " Руб.");
        });

        function getProducts(){
            let tmp = [];

            $('.count').each(function(index, value){
                let id    = $(value)[0].dataset.id;
                let count = $(value).val();
                
                tmp.push({count : count, id : id});
            });

            return tmp;      
        }

        getProducts();

        $('body').on('click','.basket',function(){
            let sum = 0;
            
            $('.sum').each(function(index, value){
                
                let price = Number($(value).text().replace(/\D/g,''));
                
                sum += price;
            });

            $('.main-sum').text('Сумма заказа: ' + sum + ' Руб.');
        });

        $('body').on('click','.btn-del',function(){
            
            let id = $(this).val();

           axios.delete(url + '/' + id)
           .then(function(){
                $('#item-'+id).hide(500, function(){
                    $(this).remove();
                });
           })
        })

      

        $('body').on('click','.save',function(){
            let phone    = $('#phone').val();
            let name     = $('#name').val();
            let products = getProducts(); 
            let sum      = Number($('.main-sum').text().replace(/\D/g, ''));

            

            if(phone.match(/^\8\d{10}$/g) == null){
                
                alert('Некоректно введен номер телефона');
                
                return false;
            }

            if(name.match(/^[А-Я]{1}[а-я]+$/g) == null){

                alert('Некоректно введено имя');
                 
                return false;
            }

            axios.post(url, {'name' : name, 'phone' : phone, products : products, sum : sum})
            .then(function(res){
                console.log(res);
                alert('Заявка была успешно отправленна');
                location.reload(true);
            })
            .catch(function(){
                alert('Произошла ошибка');
            })
        });

        
    });
</script>

@endsection
