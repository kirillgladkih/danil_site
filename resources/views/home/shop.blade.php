@extends('app')

@section('title')Вкусняшки от Торяшки@endsection

@section('styles')

@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
<div class="text-center">
    <a href="{{ route('basket.index') }}" class="btn btn-danger col-4 pt-3 pb-3">Перейти в корзину</a>
</div>
<div class="products justify-content-center d-flex flex-column flex-md-row pt-4 pb-4">
    @foreach ($data as $item)
        <div class="product_item col-12 col-md-4">
            <div class="product-img">
                <img src="{{ asset($item->img_path) }}">
            </div>
            <div class="product_about text-center pt-4">
                <h5>{{ $item->name }}</h5>
                    <p class="product-price">Цена: {{ $item->price }} Руб.</p>
                    <div class="form-group">
                        <button class="btn btn-danger btn-add" style="padding: 1.25em 2em;" value="{{ $item->id }}">Добавить в корзину</button>
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
        $('body').on('click', '.btn-add', function(){
        	let count = prompt ('Введите колличесво', '');
        	let id    = $(this).val();
        	
            let url   = location.href; 
            
            if(count == null)
                return 0;

        	if (count.match(/\d+/) == null){
        		alert ('Вы ввели не число');
        		return 0;
        	}else{

                if(count <= 0)
                    return 0;

        		axios.post(url, {'count' : count, 'id' : id})
                .then(function(res){
                    console.log(res);
                    alert('Товар был успешно добавлен');
                })
                .catch(function(){
                    alert('Произошла ошибка');
                })
        	}
          
        });
    });
</script>

@endsection
