<h1>{{ $name }} сделал заказ</h1>

<h3> номер телефона : {{ $phone }} </h3>

<p>
    @foreach($body as $value)
        <strong>{{ $value }}</strong>
        <br>
    @endforeach
    <strong>{{ $sum }}</strong>
</p>