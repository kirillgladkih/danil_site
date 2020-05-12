<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('images/sloi_1.png') }}" type='img'>    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Админ панель</title>
  </head>
  <body>
    <header class="pb-5">
      <div class="inner_header">
        <div class="container-fluid">
           <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">Админ панель</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                           
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.request.index') }}">Заявки</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.order.index') }}">Заказы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.logout') }}">Выход</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
      </div>
    </header>
  <main>
    <div class="inner_main">
        <div class="container-fluid">
            <div class="card-header mt-5">
                <h3 class="text-center" style="color: #333333">Заявки</h3>
            </div>
            
            <div class="card-block p-0">
                <table class="table table-bordered table-sm m-0 text-center">
                    <thead class="">
                        <tr>
                            
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Подтвердть</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($requests as $item)
                           <tr class="request-{{ $item->id }}">
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td width='50px'>
                                    <button class="btn btn-primary request" value="{{ $item->id }}" 
                                        data-block="request-{{ $item->id }}">
                                        +
                                    </button>
                                </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <div class="mt-3">
                        <?php echo $requests->render(); ?>
                    </div>
                </div>
        </div>
      
    </div>
    </div>
  </main>
  <footer>
    <div class="inner_footer">
        <div class="container-fluid">
               
        </div>  
    </div>
  </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js" integrity="sha256-bd8XIKzrtyJ1O5Sh3Xp3GiuMIzWC42ZekvrMMD4GxRg=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        let url = location.href.replace(/\?page=\d+/, '');

        $('body').on('click', '.request', function(){
            let id     = $(this).val();
            let block  = $(this)[0].dataset.block;
            

            $('.'+block).hide(1000);

            axios.delete(url + '/' + id)
            .then(function(res){
                alert('Успешно');
            })
            .catch(function(res){
                alert('Произошла ошибка');
            })
        });
    });
</script>


    </body>
</html>





  

  

  