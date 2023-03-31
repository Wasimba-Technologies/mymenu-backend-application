
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
            text-align: center;
        }

        h1, h3, p {
            margin:0;
            padding:0;
            line-height : 25px;
        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        @page {
            size: 5in 8.7in;
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
        }


        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .qr-code{
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .cant-scan{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .restaurant{
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
    <header>
        <div style="margin-bottom: 10px">
            <img id="logo" src="data:image/png;base64,
            {{ base64_encode(file_get_contents(public_path('storage/'.$tenant->logo))) }}"
                 alt="logo" style="width: 80px; height: 80px;"
            />
        </div>
    </header>
    <h1 class="restaurant">{{$tenant->name}}</h1>
    <p class="address">{{$tenant->address_one}} | {{$tenant->address_two}} | {{$tenant->country}}</p>

    <div class="qr-code">
        <img id="logo" src="data:image/png;base64,
            {{ base64_encode(file_get_contents(public_path('storage/'.$table->qr_code))) }}"
             alt="logo" style="align-content:center; width: 350px; height: 400px;"
        />
    </div>

    <h3>Point your Camera here</h3>
    <h3>to access our menu instantly</h3>

    <div class="cant-scan">
        <p style="color: grey">Cant Scan? Visit the below link for the menu:</p>
        <p style="color: grey">www.mymenu.co.tz/browse/{{$table->id}}</p>
    </div>

    <div>
        <p style=" font-weight: bold; color: grey">
            Powered By:
            <span style="color:grey; font-weight: bold">
                MyMenu
            </span>
        </p>
        <p style="color: grey">
            Serving Intelligently
        </p>
    </div>

</body>

</html>
