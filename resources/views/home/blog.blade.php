    <!-- book a table Section  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
        <div class="">
            <h2 class="section-title mb-5">BOOK A TABLE</h2>
            <form action="{{url('book_table')}}" method="POST">
            @csrf
            <div class="row mb-5">
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="text" id="booktable" class="form-control form-control-lg custom-form-control" name="phone" placeholder="Phone Number">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="number" id="booktable" class="form-control form-control-lg custom-form-control" name="a_guest" placeholder="NUMBER OF GUESTS" max="20" min="0">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="time" id="booktable" class="form-control form-control-lg custom-form-control" name="time" placeholder="Time">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="date" id="booktable" class="form-control form-control-lg custom-form-control" name="date" placeholder="Date">
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg" value="Book Now">
            </form>
        </div>
    </div>

    <!-- BLOG Section  -->
    <div id="blog" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        <h2 class="section-title py-5">Our Foods</h2>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="foods" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    @foreach($data as $data)
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img height="200" src="{{ asset('storage/'.$data->image) }}" alt="">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">{{$data->price}}</a></h1>
                                <h4 class="pt20 pb20">{{$data->title}}</h4>
                                <p class="text-white">{{$data->detail}}</p>
                            </div>
                            <form action="{{url('add_cart',$data->id)}}" method="post">
                                @csrf
                            <input value="1" type="number" min="1" name="qty" required>
                            
                            <input type="submit" value="Order Now"   class="btn btn-primary" >
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
