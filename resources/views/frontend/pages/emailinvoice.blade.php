<html>
    <head>
        <style>
.container{
                background: white;
                padding: 50px 50px;
                min-height: 100vh;
                width: 22cm;
                padding-bottom: 100px;
            }
            ul{
                list-style: none;
                font-size: 12px;
                padding-left: 0;
            }
            tbody{
                min-height: 200px;
            }
            .table td, .table th{
                border-top: none;
                border-right: 1px solid #22222240;
                border-left: 1px solid #22222240;
            }
            .invoice{
                padding: 5px 5px;
                text-align: center;
                background-color: #dddddd;
                font-size: 20px;
            }
            .information{
                margin-top: 30px;
            }
            .logo img{
                float: right;
                height: 29px;
                margin-top: 20px;
                padding-right: 20px;
            }
            h4{
                background: #dddddd;
                padding: 5px 5px;
                text-align: center;
                font-size: 14px;
                margin-bottom: 0; 
            }
            .table td, .table th {
                padding: 0.3rem;
                font-size: 12px;
            }
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #e9ecef;
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="container">
            <h3 class="invoice"><strong>Invoice</strong></h3>
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo">
                        <img src="{{URL::asset('frontend/img/logo/2.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row information">
                <div class="col-md-6">
                    <ul>
                        <li><p><strong>Ram Babu Magar</strong></p></li>
                        <li>13 street, Ratopool <span>Kathmandu Nepal</span></li>
                        <li>tel: +977 9851100000 </li>
                        <li>email: rambabu@gmail.com</li>
                    </ul>
                </div>
                <div class="col-sm-6" style="text-align: right; margin-top:40px">
                    <ul>
                        <li><p><strong>Ktm Liquor Ltd.</strong></p></li>
                        <li>12th street sanothimi <span>Bhaktapur Nepal</span></li>
                        <li>tel: +977 9851100000</li>
                        <li>email: email@ktmliquors.com</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul>
                        <li><strong>#Invoice No: 20032</strong></li>
                        <li>Order Date: 2020-feb-09</li>
                        <li>Delivery Date: 2020-feb-10</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4><strong>Invoice Detail</strong></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Particulars</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Jack Denials - 700ml</td>
                                <td>1</td>
                                <td>10000</td>
                                <td>10000</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Red Label - 700ml</td>
                                <td>1</td>
                                <td>10000</td>
                                <td>10000</td>
                            </tr>
                            <tr style="border-top: 1px solid #22222240">
                                <td colspan="4" style="text-align: right"><strong>Sub-Total</strong></td>
                                <td><strong>Rs 10000</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>Discount</strong></td>
                                <td><strong>Rs 0</strong></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #22222240">
                                <td colspan="4" style="text-align: right"><strong>Total</strong></td>
                                <td><strong>Rs 10000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="notes">
                        <ul>
                            <li><strong>Important Notes</strong></li>
                            <li>This is just a demo notes 1</li>
                            <li>Demo notes 2 for company</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>