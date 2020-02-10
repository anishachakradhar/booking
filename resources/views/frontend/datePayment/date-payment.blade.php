@extends('layouts.frontend')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Confirm payment for date booked 
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name"  value="{{$book_date->student->name }}" readonly>
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email"  value="{{$book_date->student->email }}" readonly>
                            <label for="date">Date Booked</label>
                            <input class="form-control" type="text" name="date"  value="{{$book_date->date->available_date }}" readonly>
                            <label for="date">Temporary Booking Code</label>
                            <input class="form-control" type="text" name="temp"  value="{{$book_date->temp_booking_code }}" readonly>
                        </div>
                        <button class="btn btn-success" id="payment-button">Pay with Khalti</button>
                        <script>
                            var config = {
                                // replace the publicKey with yours
                                "publicKey": "{{env('KHALTI_PUBLIC_KEY')}}",
                                "productIdentity": "{{$book_date->student->student_id}}",
                                "productName": "{{$book_date->book_date_id}}",
                                "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                                "eventHandler": {
                                    onSuccess (payload) {
                                        // hit merchant api for initiating verfication
                                        // alert(1);
                                        req = axios.post("{{route('student.date-payment.verification')}}", {
                                            token: payload.token,
                                            amount: payload.amount,
                                            product_identity: payload.product_identity,
                                            product_name: payload.product_name,
                                        })
                                        .then((response) => {
                                            console.log(response);
                                            window.location.replace("{{route('student.date-payment.payment-result',$book_date->book_date_id)}}");
                                        }, (error) => {
                                            console.log(error);
                                            window.location.replace("{{route('student.date-payment.payment-result',$book_date->book_date_id)}}");
                                        });
                                        // req.then(x => console.log("Done!"));
                                        // console.log(payload);
                                    },
                                    onError (error) {
                                        console.log(error);
                                    },
                                    onClose () {
                                        console.log('widget is closing');
                                    }
                                }
                            };
                            var checkout = new KhaltiCheckout(config);
                            var btn = document.getElementById("payment-button");
                            btn.onclick = function () {
                                checkout.show({amount: 1000});
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection