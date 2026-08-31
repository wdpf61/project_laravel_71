<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Order Checkout</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        body {
            background: #f4f6f9;
        }

        .checkout-container {
            max-width: 1250px;
            margin: 30px auto;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,.07);
        }

        .product-card {
            cursor: pointer;
            transition: .2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,.12);
        }

        .product-image {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-placeholder {
            height: 130px;
            background: #eef1f5;
            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 45px;
            color: #999;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .qty-input {
            width: 70px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .grand-total {
            font-size: 22px;
            font-weight: 700;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            font-size: 17px;
            font-weight: 600;
        }

    </style>

</head>


<body>


<div class="container checkout-container">


    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-cart-check"></i>

                Create Order

            </h2>

            <p class="text-muted mb-0">
                Select products and complete checkout
            </p>

        </div>

    </div>


    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('orders.store') }}"
        method="POST"
        id="orderForm"
    >

        @csrf


        <div class="row g-4">


            <!-- ================================= -->
            <!-- PRODUCTS -->
            <!-- ================================= -->

            <div class="col-lg-7">

                <div class="card">

                    <div class="card-header bg-white p-3">

                        <h5 class="mb-0">

                            <i class="bi bi-box-seam"></i>

                            Products

                        </h5>

                    </div>


                    <div class="card-body">


                        <div class="row g-3">


                            @foreach($products as $product)

                                <div class="col-md-4">


                                    <div
                                        class="card product-card h-100"
                                        onclick="addProduct(
                                            {{ $product->id }},
                                            '{{ addslashes($product->name) }}',
                                            {{ $product->price }},
                                            {{ $product->qty }}
                                        )"
                                    >


                                        <div class="card-body">


                                            @if($product->photo)

                                                <img
                                                    src="{{ asset($product->photo) }}"
                                                    class="product-image mb-2"
                                                >

                                            @else

                                                <div class="product-placeholder mb-2">

                                                    <i class="bi bi-image"></i>

                                                </div>

                                            @endif


                                            <h6 class="fw-bold">

                                                {{ $product->name }}

                                            </h6>


                                            <div class="text-primary fw-bold">

                                                ৳ {{ number_format($product->price, 2) }}

                                            </div>


                                            <small class="text-muted">

                                                Stock:
                                                {{ $product->qty }}

                                            </small>


                                        </div>

                                    </div>

                                </div>

                            @endforeach


                        </div>


                    </div>

                </div>

            </div>



            <!-- ================================= -->
            <!-- CART -->
            <!-- ================================= -->

            <div class="col-lg-5">


                <div class="card mb-4">


                    <div class="card-header bg-white p-3">

                        <h5 class="mb-0">

                            <i class="bi bi-cart"></i>

                            Order Items

                        </h5>

                    </div>


                    <div class="card-body">


                        <div id="cart">

                            <div
                                class="text-center text-muted py-5"
                                id="emptyCart"
                            >

                                <i
                                    class="bi bi-cart-x fs-1"
                                ></i>

                                <p class="mt-2">

                                    No products added

                                </p>

                            </div>

                        </div>


                    </div>

                </div>



                <!-- ================================= -->
                <!-- CUSTOMER -->
                <!-- ================================= -->

                <div class="card mb-4">


                    <div class="card-header bg-white p-3">

                        <h5 class="mb-0">

                            <i class="bi bi-person"></i>

                            Customer

                        </h5>

                    </div>


                    <div class="card-body">


                        <label class="form-label">

                            Select Customer

                        </label>


                        <select
                            name="customer_id"
                            id="customer_id"
                            class="form-select"
                            required
                        >

                            <option value="">

                                Select Customer

                            </option>


                            @foreach($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    data-address="{{ $customer->address }}"
                                >

                                    {{ $customer->name }}

                                    -
                                    {{ $customer->phone }}

                                </option>

                            @endforeach

                        </select>


                        <div class="mt-3">


                            <label class="form-label">

                                Shipping Address

                            </label>


                            <textarea
                                class="form-control"
                                id="shipping_address"
                                rows="2"
                                readonly
                            ></textarea>


                        </div>


                        <div class="mt-3">


                            <label class="form-label">

                                Customer Note

                            </label>


                            <textarea
                                name="customer_note"
                                class="form-control"
                                rows="2"
                                placeholder="Optional note..."
                            ></textarea>


                        </div>


                    </div>

                </div>



                <!-- ================================= -->
                <!-- ORDER SUMMARY -->
                <!-- ================================= -->

                <div class="card">


                    <div class="card-body">


                        <h5 class="fw-bold mb-3">

                            Order Summary

                        </h5>


                        <div class="summary-row">

                            <span>

                                Subtotal

                            </span>

                            <strong>

                                ৳ <span id="subtotal">0.00</span>

                            </strong>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">

                                Discount

                            </label>

                            <input
                                type="number"
                                name="discount"
                                id="discount"
                                class="form-control"
                                value="0"
                                min="0"
                                step="0.01"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">

                                Shipping Charge

                            </label>

                            <input
                                type="number"
                                name="shipping_charge"
                                id="shipping_charge"
                                class="form-control"
                                value="0"
                                min="0"
                                step="0.01"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">

                                Tax

                            </label>

                            <input
                                type="number"
                                name="tax"
                                id="tax"
                                class="form-control"
                                value="0"
                                min="0"
                                step="0.01"
                            >

                        </div>


                        <div class="summary-row">

                            <span>

                                Discount

                            </span>

                            <strong class="text-danger">

                                - ৳ <span id="discountDisplay">
                                    0.00
                                </span>

                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>

                                Shipping

                            </span>

                            <strong>

                                ৳ <span id="shippingDisplay">
                                    0.00
                                </span>

                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>

                                Tax

                            </span>

                            <strong>

                                ৳ <span id="taxDisplay">
                                    0.00
                                </span>

                            </strong>

                        </div>


                        <div class="summary-row grand-total">

                            <span>

                                Grand Total

                            </span>

                            <span>

                                ৳ <span id="grandTotal">
                                    0.00
                                </span>

                            </span>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-success checkout-btn mt-3"
                            id="checkoutBtn"
                        >

                            <i class="bi bi-credit-card"></i>

                            Proceed to Payment

                        </button>


                    </div>

                </div>


            </div>


        </div>

    </form>

</div>



<script>

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    let cart = [];


    /*
    |--------------------------------------------------------------------------
    | Add Product
    |--------------------------------------------------------------------------
    */

    function addProduct(id, name, price, stock)
    {

        let existing = cart.find(
            item => item.product_id === id
        );


        if (existing) {

            if (existing.qty >= stock) {

                alert('Stock limit reached');

                return;
            }

            existing.qty++;

        } else {

            cart.push({

                product_id: id,

                product_name: name,

                price: parseFloat(price),

                qty: 1,

                stock: stock

            });

        }


        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | Change Quantity
    |--------------------------------------------------------------------------
    */

    function changeQty(index, qty)
    {

        qty = parseFloat(qty);


        if (qty <= 0) {

            removeProduct(index);

            return;
        }


        if (qty > cart[index].stock) {

            alert(
                'Maximum stock: ' +
                cart[index].stock
            );

            qty = cart[index].stock;
        }


        cart[index].qty = qty;


        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | Remove Product
    |--------------------------------------------------------------------------
    */

    function removeProduct(index)
    {

        cart.splice(index, 1);

        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | Render Cart
    |--------------------------------------------------------------------------
    */

    function renderCart()
    {

        let cartElement =
            document.getElementById('cart');

        let emptyCart =
            document.getElementById('emptyCart');


        if (cart.length === 0) {

            cartElement.innerHTML = `

                <div
                    class="text-center text-muted py-5"
                >

                    <i
                        class="bi bi-cart-x fs-1"
                    ></i>

                    <p class="mt-2">
                        No products added
                    </p>

                </div>

            `;

            calculateTotal();

            return;
        }


        let html = '';


        cart.forEach((item, index) => {


            let total =
                item.price * item.qty;


            html += `

                <div class="cart-item">

                    <div
                        class="d-flex
                               justify-content-between
                               align-items-center"
                    >

                        <div>

                            <strong>
                                ${item.product_name}
                            </strong>

                            <div class="text-muted small">

                                ৳ ${item.price.toFixed(2)}
                                ×
                                ${item.qty}

                            </div>

                        </div>


                        <div class="text-end">

                            <strong>
                                ৳ ${total.toFixed(2)}
                            </strong>


                            <div
                                class="d-flex
                                       align-items-center
                                       gap-2 mt-2"
                            >

                                <input

                                    type="number"

                                    class="form-control
                                           form-control-sm
                                           qty-input"

                                    value="${item.qty}"

                                    min="1"

                                    max="${item.stock}"

                                    onchange="
                                        changeQty(
                                            ${index},
                                            this.value
                                        )
                                    "

                                >


                                <button

                                    type="button"

                                    class="btn btn-sm
                                           btn-outline-danger"

                                    onclick="
                                        removeProduct(${index})
                                    "

                                >

                                    <i
                                        class="bi bi-trash"
                                    ></i>

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            `;

        });


        cartElement.innerHTML = html;


        calculateTotal();

    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Total
    |--------------------------------------------------------------------------
    */

    function calculateTotal()
    {

        let subtotal = 0;


        cart.forEach(item => {

            subtotal +=
                item.price * item.qty;

        });


        let discount =
            parseFloat(
                document.getElementById('discount').value
            ) || 0;


        let shipping =
            parseFloat(
                document.getElementById('shipping_charge').value
            ) || 0;


        let tax =
            parseFloat(
                document.getElementById('tax').value
            ) || 0;


        let grandTotal =
            subtotal
            - discount
            + shipping
            + tax;


        if (grandTotal < 0) {

            grandTotal = 0;

        }


        document.getElementById('subtotal')
            .innerText =
            subtotal.toFixed(2);


        document.getElementById('discountDisplay')
            .innerText =
            discount.toFixed(2);


        document.getElementById('shippingDisplay')
            .innerText =
            shipping.toFixed(2);


        document.getElementById('taxDisplay')
            .innerText =
            tax.toFixed(2);


        document.getElementById('grandTotal')
            .innerText =
            grandTotal.toFixed(2);

    }


    /*
    |--------------------------------------------------------------------------
    | Input Events
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('discount')
        .addEventListener(
            'input',
            calculateTotal
        );


    document
        .getElementById('shipping_charge')
        .addEventListener(
            'input',
            calculateTotal
        );


    document
        .getElementById('tax')
        .addEventListener(
            'input',
            calculateTotal
        );


    /*
    |--------------------------------------------------------------------------
    | Customer Address
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('customer_id')
        .addEventListener(
            'change',
            function ()
            {

                let option =
                    this.options[this.selectedIndex];


                let address =
                    option.dataset.address || '';


                document.getElementById(
                    'shipping_address'
                ).value = address;

            }
        );


    /*
    |--------------------------------------------------------------------------
    | Before Submit
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('orderForm')
        .addEventListener(
            'submit',
            function (e)
            {

                if (cart.length === 0) {

                    e.preventDefault();

                    alert(
                        'Please add at least one product.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Add Cart Items To Form
                |--------------------------------------------------------------------------
                */

                cart.forEach(
                    (item, index) => {


                        let productId =
                            document.createElement('input');

                        productId.type = 'hidden';

                        productId.name =
                            `products[${index}][product_id]`;

                        productId.value =
                            item.product_id;


                        let qty =
                            document.createElement('input');

                        qty.type = 'hidden';

                        qty.name =
                            `products[${index}][qty]`;

                        qty.value =
                            item.qty;


                        this.appendChild(
                            productId
                        );

                        this.appendChild(
                            qty
                        );

                    }
                );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | Initial Render
    |--------------------------------------------------------------------------
    */

    renderCart();

</script>


</body>

</html>