@extends('app')

@section('title')Вкусняшки от Торяшки@endsection

@section('styles')
<link rel="shortcut icon" href="{{ asset('images/sloi_1.png') }}" type='img'>    
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
<div class="text-center">
    <a href="{{ route('shop.index') }}" class="btn btn-danger col-4 pt-3 pb-3">В магазин</a>
</div>
<div class="main_form mt-4 mb-4">
    <form>
      <div class="form-group text-center">
        <h4 style="color: white">Оставить заявку</h4>
      </div>
      <div class="form-group">
        <input placeholder="Имя" type="text" class="form-control name">
      </div>
      <div class="form-group">
        <input placeholder="89008080600" class="form-control tel">
      </div>
      <div class="form-group text-center">
        <button type="button" class="btn btn-danger col-4 pt-3 pb-3 request">Оставить заявку</button>
      </div>
    </form>
</div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        
        let url = location.href;

        $('body').on('click','.request',function(){
            let phone = $('.tel').val();
            let name  = $('.name').val();
            
            if(phone.match(/^\8\d{10}$/g) == null){
                
                alert('Некоректно введен номер телефона');
                
                return false;
            }

            if(name.match(/^[А-Я]{1}[а-я]+$/g) == null){

                alert('Некоректно введено имя');
                
                return false;

            }

            axios.post(url, {'name' : name, 'phone' : phone})
            .then(function(){
                alert('Заявка было успешно отправленна');
            })
            .catch(function(){
                alert('Произошла ошибка');
            })
           
        });

        
    });
</script>

@endsection
