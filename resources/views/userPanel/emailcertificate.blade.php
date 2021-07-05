<!DOCTYPE html>
<html>
    <head>
        <title>kttoems</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <style>
        @font-face {
            font-family: DeliciousRoman;
            src: url(https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap);
        }
        </style>
    <body bgcolor="#e3e3e3">
        <table
            border="0"
            cellpadding="0"
            cellspacing="0"
            style="width: 100%; border: 1px solid #d5d5d5; max-width: 1000px;"
            align="center"
        >
            <tr>
                <td
                    style="background-color: #ffffff; padding: 15px"
                    align="center"
                    valign="middle"
                >
                    <img style="width:400px;" src="https://upload.wikimedia.org/wikipedia/commons/8/84/UC_Official_Logo.png" alt="">
                </td>
            </tr>
            <tr>
                <td valign="top" align="middle">
                    <table
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        style="
                            width: 100%;
                            background-color: #ffffff;
                            padding: 20px;
                            text-align: center;
                        "
                    >
                        <tr>
                            <td
                                style="
                                    display: inline-block;
                                    max-width: 1000px;
                                    width: 100%;
                                "
                                align="center"
                            >
                                <p
                                    style="
                                        margin: 10px 0px;
                                        font-size: 50px;
                                        color: #6a6a6a;
                                        text-transform: capitalize;
                                        font-family: 'Poppins', sans-serif;
                                        font-weight: normal;
                                    "
                                >
                                    Thank you for Your feedback
                                    <br />
                                    <span style="font-weight: bold;color:#114161;">{{$data['firstname'] .' '.$data['middlename'] .' '. $data['lastname']}}</span>
                                </p>
                                <p
                                    style="
                                        margin: 0;
                                        font-size: 16px;
                                        color: #444444;
                                        margin-bottom: 1px;
                                        text-transform: capitalize;
                                    "
                                ></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p 
                                style="
                                    margin: 0;
                                    font-size: 20px;
                                    color: #c29191;
                                    margin-bottom: 10px;
                                    font-family: 'Poppins', sans-serif;
                                ">
                                    Your Certificate is ready to download
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top:2px solid rgb(211, 211, 211);">
                                <p 
                                style="
                                    margin: 0;
                                    font-size: 20px;
                                    color: #857a7a;
                                    margin-top: 20px;
                                    font-family: 'Poppins', sans-serif;
                                ">
                                    Team KTTOEMS
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
