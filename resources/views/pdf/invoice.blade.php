
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 2.8in 11in;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;

        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 60%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 12px;
        }


        .items .heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top:1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            font-family: serif;
            text-align: right;
        }

        .sum-up {
            text-align: right !important;
        }
        .total {
            font-size: 13px;
            border-top:1px dashed black !important;
            border-bottom:1px dashed black !important;
        }
        .total.text, .total.price {
            text-align: right;
        }
        .total.price::before {
            //content: "Tsh";
        }
        .line {
            border-top:1px solid black !important;
        }
        .heading.rate {
            width: 20%;
        }
        .heading.amount {
            width: 25%;
        }
        .heading.qty {
            width: 5%
        }
        p {
            padding: 1px;
            margin: 0;
        }
        .restaurant{
            font-size: larger;
            text-align: center;
            font-weight: bolder;
        }
        section, footer {
            font-size: 12px;
        }
        .address{
            font-size: xx-small;
            margin-bottom: 16px;
            text-align: center;
        }
        .receipt {
            font-size: medium;
            font-weight: bolder;
            margin-bottom: 22px;
        }
    </style>
</head>

<body>
<header>
    <div id="logo" class="media" data-src="logo.png" src="./logo.png"></div>
</header>
<p class="restaurant">{{$tenant->name}}</p>
<p class="address">{{$tenant->email}}</p>
<table class="bill-details">
    <tbody>
    <tr>
        <td class="center-align" colspan="2"><span class="receipt">Proforma Invoice</span></td>
    </tr>
    <tr>
        <td colspan="2">Date : <span>{{$order->created_at}}</span></td>
    </tr>
    <tr>
        <td>Table #: <span>{{$order->table->id}}</span></td>
        <td>Bill # : <span>{{$order->id}}</span></td>
    </tr>
    <tr>
        <td colspan="2">Status : <span style="font-weight: bolder">{{$order->status}}</span></td>
    </tr>
    </tbody>
</table>

<table class="items">
    <thead>
    <tr>
        <th class="heading name">Item</th>
        <th class="heading qty">Qty</th>
        <th class="heading rate">Rate</th>
        <th class="heading amount">Amount</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($order->menu_items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->pivot->qty}}</td>
                <td class="price">{{number_format($item->price)}}</td>
                <td class="price">{{number_format($item->price * $item->pivot->qty)}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="sum-up line">Subtotal</td>
            <td class="line price">{{number_format($total)}}</td>
        </tr>
        <tr>
            <td colspan="3" class="sum-up">Tax</td>
            <td class="price">{{number_format($total * 0.18)}}</td>
        </tr>
        <tr>
            <th colspan="3" class="total text">Total</th>
            <th class="total price">{{number_format($total + ($total * 0.18))}}</th>
        </tr>
    </tbody>
</table>
<section>
{{--    <p>--}}
{{--        Paid by : <span>CASH</span>--}}
{{--    </p>--}}
    <p style="margin-top:12px; text-align:center">
        Thank you for your visit!
    </p>
</section>
<footer style="margin-top:18px; text-align:center">
    <p>Powered By MyMenu</p>
    <p>www.mymenu.co.tz</p>
</footer>
</body>

</html>
