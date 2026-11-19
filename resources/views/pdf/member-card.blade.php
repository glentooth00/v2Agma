
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: 85.6mm 54mm;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #ffffff;
        }

        .card {
            width: 85.6mm;
            height: 54mm;
            background-color: #172B3A;
            padding: 5mm;
            position: relative;
        }

        .header {
            border-bottom: 1px solid #526675;
            padding-bottom: 2mm;
        }

        .brand {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #A8C58D;
            font-size: 6px;
            letter-spacing: 1.5px;
            margin-top: 2px;
        }

        .content {
            text-align: center;
            padding-top: 2mm;
        }

        .qr {
            width: 19mm;
            height: 19mm;
            background-color: #ffffff;
            margin: 0 auto 1mm;
            padding: 1mm;
            text-align: center;
        }

        .qr svg {
            width: 100%;
            height: 100%;
        }

        .scan-label {
            color: #A8C58D;
            font-size: 5px;
            letter-spacing: 1px;
            margin-bottom: 1.5mm;
        }

        .member-name {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 1mm;
        }

        .membership-id {
            font-size: 7px;
            color: #A8C58D;
        }

        .account {
            font-size: 7px;
            margin-top: 1mm;
        }

        .footer {
            position: absolute;
            bottom: 3mm;
            left: 5mm;
            right: 5mm;
            border-top: 1px solid #526675;
            padding-top: 2mm;
            text-align: center;
            font-size: 5px;
            letter-spacing: 1px;
            color: #A8C58D;
        }
    </style>
</head>

<body>
    <div class="card">

        {{-- HEADER --}}
        <div class="header">
            <div class="brand">AGMA ONE</div>
            <div class="subtitle">
                OFFICIAL ASSEMBLY ACCESS · MEMBER PASS
            </div>
        </div>

        {{-- MEMBER QR CARD --}}
        <div class="content">

            <div class="qr">
                {!! $qrCode !!}
            </div>

            <div class="scan-label">
                SCAN TO VERIFY MEMBERSHIP
            </div>

            {{-- MEMBER NAME --}}
            <div class="member-name">
                {{ $member->firstname }}
                {{ $member->middlename }}
                {{ $member->lastname }}
            </div>

            {{-- MEMBERSHIP ID --}}
            <div class="membership-id">
                MEMBERSHIP ID: {{ $member->membership_id }}
            </div>

            {{-- ACCOUNT NUMBER --}}
            <div class="account">
                ACCOUNT NUMBER: {{ $accountNumber }}
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="footer">
            PRESENT THIS PASS AT THE ASSEMBLY
        </div>

    </div>
</body>
</html>
