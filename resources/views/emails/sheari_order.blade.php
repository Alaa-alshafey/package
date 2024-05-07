<div style="width: 600px; text-align: center; padding: 10px; border: 1px solid #00a65a; border-radius: 10px">


    <style>
        table{
            border-collapse: collapse;
            width: 800px;
            border: 2px solid #555;
        }
        table, th, td {

            border: 2px solid #555;
        }
        th {
            background-color: #4CAF50;
            text-align: right;
        }
        td{
            text-align: right;
        }
        th, td{
            padding: 10px;
        }
        .content tr:hover {background-color: #f5f5f5;}

        .content tr:nth-child(even) {background-color: #f2f2f2;}
    </style>

    <div style='' class='content'>

        <div style='margin: 40px 0px'>
            <h2>بيانات مزود الخدمة</h2>
            <table style="width: 100%">
                <thead>
                <tr>
                    <th>اسم المزود</th>
                    <th>البريد الالكتروني</th>
                    <th>الجوال</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{($order->provider->name??'')}}</td>
                    <td>{{($order->provider->email??'')}}</td>
                    <td>{{($order->provider->phone??'')}}</td>
                </tr>
                </tbody>
            </table>

            <br>
            <br>
            <h2>بيانات المستخدم</h2>

            <table style="width: 100%">
                <thead>
                <tr>
                    <th>اسم المستخدم</th>
                    <th>البريد الالكتروني</th>
                    <th>الجوال</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{($order->user->name??'')}}</td>
                    <td>{{($order->user->email??'')}}</td>
                    <td>{{($order->user->phone??'')}}</td>
                </tr>
                </tbody>
            </table>

            <h2>بيانات الطلب</h2>

            <table style="width: 100%">
                <thead>
                <tr>
                    <th>عنوان الطلب</th>
                    <th>الميزانية التقديرية بالريال</th>
                    <th>الخصم %</th>
                    <th>الميزانية بعد الخصم بالريال</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{($order->title??'')}}</td>
                    <td>{{($order->expected_money??'')}}</td>
                    <td>{{($order->discount??'')}}</td>
                    <td>{{($order->price_after_discount??'')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>