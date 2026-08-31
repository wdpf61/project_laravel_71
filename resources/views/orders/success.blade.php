
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Order Success - {{ $order->order_no }}
    </title>


    <!-- Bootstrap -->

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
            background: #f3f5f9;
            font-family: Arial, sans-serif;
        }


        .success-wrapper {
            max-width: 900px;
            margin: 50px auto;
        }


        .success-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
            overflow: hidden;
        }


        .success-header {
            text-align: center;
            padding: 40px 20px 30px;
            background: #f8fff9;
            border-bottom: 1px solid #eee;
        }


        .success-icon {
            width: 80px;
            height: 80px;
            margin: auto;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #198754;
            color: white;

            font-size: 42px;
        }


        .success-title {
            font-weight: 700;
            margin-top: 20px;
        }


        .invoice-body {
            padding: 35px;
        }


        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            border-bottom: 1px solid #ddd;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }


        .company-name {
            font-size: 24px;
            font-weight: 700;
        }


        .invoice-title {
            font-size: 28px;
            font-weight: 700;
        }


        .invoice-info {
            color: #666;
            line-height: 1.8;
        }


        .customer-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 18px;
            height: 100%;
        }


        .customer-title {
            font-weight: 700;
            margin-bottom: 10px;
        }


        table th {
            background: #f8f9fa !important;
        }


        .total-box {
            max-width: 350px;
            margin-left: auto;
        }


        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }


        .grand-total {
            border-top: 2px solid #222;
            margin-top: 8px;
            padding-top: 15px;

            font-size: 21px;
            font-weight: 700;
        }


        .paid-badge {
            display: inline-block;

            background: #d1e7dd;
            color: #0f5132;

            padding: 6px 14px;
            border-radius: 30px;

            font-size: 13px;
            font-weight: 600;
        }


        .invoice-footer {
            border-top: 1px solid #ddd;

            margin-top: 30px;
            padding-top: 20px;

            text-align: center;
            color: #777;
        }


        .action-buttons {
            margin-top: 25px;
            text-align: center;
        }


        @media print {

            body {
                background: white;
            }


            .success-wrapper {
                margin: 0;
                max-width: 100%;
            }


            .success-card {
                box-shadow: none;
            }


            .action-buttons,
            .no-print {
                display: none !important;
            }


            .invoice-body {
                padding: 20px;
            }

        }

    </style>

</head>


<body>


<div class="container success-wrapper">


    <div class="success-card">


        <!-- ====================================== -->
        <!-- SUCCESS HEADER -->
        <!-- ====================================== -->

        <div class="success-header">

            <div class="success-icon">

                <i class="bi bi-check-lg"></i>

            </div>


            <h2 class="success-title">

                Payment Successful!

            </h2>


            <p class="text-muted mb-2">

                Thank you for your order.

            </p>


            <span class="paid-badge">

                <i class="bi bi-check-circle"></i>

                Payment Paid

            </span>

        </div>



        <!-- ====================================== -->
        <!-- INVOICE -->
        <!-- ====================================== -->

        <div class="invoice-body" id="invoice">


            <!-- Invoice Header -->

            <div class="invoice-header">


                <div>

                    <div class="company-name">

                        Your Company

                    </div>


                    <div class="text-muted">

                        Dhaka, Bangladesh

                    </div>


                    <div class="text-muted">

                        Phone: +880 1XXXXXXXXX

                    </div>


                    <div class="text-muted">

                        Email: info@example.com

                    </div>

                </div>


                <div class="text-end">

                    <div class="invoice-title">

                        INVOICE

                    </div>


                    <div class="invoice-info">

                        <strong>
                            Order No:
                        </strong>

                        {{ $order->order_no }}

                        <br>


                        <strong>
                            Date:
                        </strong>

                        {{ $order->created_at->format('d M Y, h:i A') }}

                        <br>


                        <strong>
                            Payment:
                        </strong>

                        SSLCommerz

                    </div>

                </div>


            </div>



            <!-- ====================================== -->
            <!-- CUSTOMER -->
            <!-- ====================================== -->

            <div class="row g-4 mb-4">


                <div class="col-md-6">


                    <div class="customer-box">

                        <div class="customer-title">

                            <i class="bi bi-person"></i>

                            Bill To

                        </div>


                        <strong>

                            {{ $order->customer->name ?? 'Customer' }}

                        </strong>


                        <br>


                        {{ $order->customer->email ?? '' }}


                        <br>


                        {{ $order->customer->phone ?? '' }}

                    </div>

                </div>



                <div class="col-md-6">


                    <div class="customer-box">

                        <div class="customer-title">

                            <i class="bi bi-geo-alt"></i>

                            Shipping Address

                        </div>


                        {{ $order->shipping_address }}

                    </div>

                </div>


            </div>



            <!-- ====================================== -->
            <!-- ORDER STATUS -->
            <!-- ====================================== -->

            <div class="mb-4">


                <div class="row">


                    <div class="col-md-6">

                        <strong>

                            Order Status:

                        </strong>


                        <span class="badge text-bg-success">

                            {{ ucfirst($order->order_status) }}

                        </span>

                    </div>


                    <div class="col-md-6 text-md-end">

                        <strong>

                            Payment Status:

                        </strong>


                        <span class="badge text-bg-success">

                            {{ ucfirst($order->payment_status) }}

                        </span>

                    </div>


                </div>

            </div>



            <!-- ====================================== -->
            <!-- ITEMS -->
            <!-- ====================================== -->

            <div class="table-responsive">


                <table class="table table-bordered align-middle">


                    <thead>

                        <tr>

                            <th width="5%">
                                #
                            </th>

                            <th>
                                Product
                            </th>

                            <th width="15%">
                                Price
                            </th>

                            <th width="12%">
                                Qty
                            </th>

                            <th width="18%" class="text-end">
                                Total
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach($order->details as $key => $item)

                            <tr>

                                <td>

                                    {{ $key + 1 }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $item->product_name }}

                                    </strong>


                                    @if($item->sku)

                                        <div class="small text-muted">

                                            SKU:
                                            {{ $item->sku }}

                                        </div>

                                    @endif

                                </td>


                                <td>

                                    ৳ {{ number_format($item->price, 2) }}

                                </td>


                                <td>

                                    {{ $item->qty }}

                                </td>


                                <td class="text-end">

                                    ৳ {{ number_format($item->total, 2) }}

                                </td>

                            </tr>

                        @endforeach


                    </tbody>

                </table>

            </div>



            <!-- ====================================== -->
            <!-- TOTAL -->
            <!-- ====================================== -->

            <div class="total-box">


                <div class="total-row">

                    <span>

                        Subtotal

                    </span>


                    <strong>

                        ৳ {{ number_format($order->subtotal, 2) }}

                    </strong>

                </div>



                <div class="total-row">

                    <span>

                        Discount

                    </span>


                    <strong class="text-danger">

                        - ৳ {{ number_format($order->discount, 2) }}

                    </strong>

                </div>



                <div class="total-row">

                    <span>

                        Shipping

                    </span>


                    <strong>

                        ৳ {{ number_format($order->shipping_charge, 2) }}

                    </strong>

                </div>



                <div class="total-row">

                    <span>

                        Tax

                    </span>


                    <strong>

                        ৳ {{ number_format($order->tax, 2) }}

                    </strong>

                </div>



                <div class="total-row grand-total">

                    <span>

                        Grand Total

                    </span>


                    <span>

                        ৳ {{ number_format($order->grand_total, 2) }}

                    </span>

                </div>


            </div>



            <!-- ====================================== -->
            <!-- FOOTER -->
            <!-- ====================================== -->

            <div class="invoice-footer">

                <strong>

                    Thank you for your purchase!

                </strong>


                <br>


                <small>

                    This is a computer generated invoice.

                </small>

            </div>


        </div>



        <!-- ====================================== -->
        <!-- ACTION BUTTONS -->
        <!-- ====================================== -->

        <div class="action-buttons no-print pb-4">


            <button
                type="button"
                onclick="window.print()"
                class="btn btn-primary me-2"
            >

                <i class="bi bi-printer"></i>

                Print Invoice

            </button>


            <a
                href="{{ route('orders.create') }}"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-plus-circle"></i>

                New Order

            </a>


        </div>


    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | Auto print - OPTIONAL
    |--------------------------------------------------------------------------
    */

    // window.onload = function () {
    //     window.print();
    // };


</script>


</body>

</html>

