
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Payment Failed</title>


    <!-- Bootstrap 5 -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        body {
            background: #f4f6f9;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Arial, sans-serif;
        }


        .payment-card {
            width: 100%;
            max-width: 650px;

            background: #fff;

            border-radius: 18px;

            box-shadow:
                0 10px 40px rgba(0, 0, 0, .08);

            overflow: hidden;
        }


        .failed-header {

            background: #fff5f5;

            padding: 45px 25px 35px;

            text-align: center;

            border-bottom: 1px solid #eee;
        }


        .failed-icon {

            width: 90px;
            height: 90px;

            margin: auto;

            border-radius: 50%;

            background: #dc3545;

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 48px;

            box-shadow:
                0 8px 20px rgba(220, 53, 69, .25);
        }


        .failed-title {

            margin-top: 22px;

            font-size: 28px;

            font-weight: 700;

            color: #212529;
        }


        .failed-description {

            color: #6c757d;

            margin-bottom: 0;
        }


        .payment-body {

            padding: 35px;
        }


        .error-box {

            background: #fff5f5;

            border: 1px solid #f5c2c7;

            border-radius: 12px;

            padding: 18px;

            color: #842029;
        }


        .order-info {

            background: #f8f9fa;

            border-radius: 12px;

            padding: 20px;

            margin-top: 20px;
        }


        .info-row {

            display: flex;

            justify-content: space-between;

            padding: 9px 0;

            border-bottom: 1px solid #e9ecef;
        }


        .info-row:last-child {

            border-bottom: 0;

        }


        .info-label {

            color: #6c757d;

        }


        .info-value {

            font-weight: 600;

        }


        .failed-badge {

            display: inline-block;

            padding: 5px 12px;

            border-radius: 20px;

            background: #f8d7da;

            color: #842029;

            font-size: 13px;

            font-weight: 600;
        }


        .btn-retry {

            padding: 12px 25px;

            font-weight: 600;

            border-radius: 9px;
        }


        .help-text {

            text-align: center;

            color: #6c757d;

            font-size: 14px;

            margin-top: 25px;
        }


        .secure-text {

            text-align: center;

            font-size: 12px;

            color: #8a8f98;

            margin-top: 20px;
        }


        @media(max-width:576px) {

            .payment-body {

                padding: 25px 20px;

            }

            .failed-title {

                font-size: 24px;

            }

            .info-row {

                flex-direction: column;

                gap: 3px;

            }

        }

    </style>

</head>


<body>


<div class="container px-3">


    <div class="payment-card">


        <!-- ================================= -->
        <!-- FAILED HEADER -->
        <!-- ================================= -->

        <div class="failed-header">


            <div class="failed-icon">

                <i class="bi bi-x-lg"></i>

            </div>


            <h1 class="failed-title">

                Payment Failed

            </h1>


            <p class="failed-description">

                Unfortunately, your payment could not be completed.

            </p>


        </div>



        <!-- ================================= -->
        <!-- BODY -->
        <!-- ================================= -->

        <div class="payment-body">


            <!-- Error Message -->

            <div class="error-box">


                <div class="d-flex align-items-start">


                    <i
                        class="bi bi-exclamation-triangle-fill
                               fs-4 me-3"
                    ></i>


                    <div>

                        <strong>

                            Payment Unsuccessful

                        </strong>


                        <div class="mt-1">

                            {{ session('error') ??
                                'Your payment was not completed. Please try again.'
                            }}

                        </div>

                    </div>


                </div>


            </div>



            <!-- Order Information -->

            @if(isset($order))


                <div class="order-info">


                    <h6 class="fw-bold mb-3">

                        <i class="bi bi-receipt"></i>

                        Order Information

                    </h6>


                    <div class="info-row">


                        <span class="info-label">

                            Order No

                        </span>


                        <span class="info-value">

                            {{ $order->order_no }}

                        </span>


                    </div>



                    <div class="info-row">


                        <span class="info-label">

                            Amount

                        </span>


                        <span class="info-value">

                            ৳ {{ number_format(
                                $order->grand_total,
                                2
                            ) }}

                        </span>


                    </div>



                    <div class="info-row">


                        <span class="info-label">

                            Payment Method

                        </span>


                        <span class="info-value">

                            SSLCommerz

                        </span>


                    </div>



                    <div class="info-row">


                        <span class="info-label">

                            Payment Status

                        </span>


                        <span>

                            <span class="failed-badge">

                                Failed

                            </span>

                        </span>


                    </div>


                </div>

            @endif



            <!-- ================================= -->
            <!-- ACTION BUTTONS -->
            <!-- ================================= -->

            <div class="d-flex justify-content-center
                        gap-2 flex-wrap mt-4">


                <a
                    href="{{ route('orders.create') }}"
                    class="btn btn-danger btn-retry"
                >

                    <i class="bi bi-arrow-repeat"></i>

                    Try Again

                </a>


                <a
                    href="{{ route('orders.create') }}"
                    class="btn btn-outline-secondary btn-retry"
                >

                    <i class="bi bi-cart"></i>

                    Back to Checkout

                </a>


            </div>



            <!-- Help -->

            <div class="help-text">

                <i class="bi bi-info-circle"></i>

                If money was deducted from your account,
                please contact support before making another payment.

            </div>


            <!-- Secure -->

            <div class="secure-text">

                <i class="bi bi-shield-check"></i>

                Payment securely processed by SSLCommerz

            </div>


        </div>

    </div>

</div>


</body>

</html>

