<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/img/favicon/favicon.ico" />

    <!-- Custom fonts for this template-->
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-m2WvSk6mEvPQZJDYo51PtwvvB5GQoOLYZcF12MLL5VaV0BkoN6I++lsTV49IMzUAc9g9eN3vGTwvVdZqfN0dEw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .container {
            height: 100%;
            width: 100%;
            font-family: Helvetica;
        }

        .loader {
            height: 20px;
            width: 250px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .loader--dot {
            animation-name: loader;
            animation-timing-function: ease-in-out;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            height: 20px;
            width: 20px;
            border-radius: 100%;
            background-color: black;
            position: absolute;
            border: 2px solid white;
        }

        .loader--dot:first-child {
            background-color: #8cc759;
            animation-delay: 0.5s;
        }

        .loader--dot:nth-child(2) {
            background-color: #8c6daf;
            animation-delay: 0.4s;
        }

        .loader--dot:nth-child(3) {
            background-color: #ef5d74;
            animation-delay: 0.3s;
        }

        .loader--dot:nth-child(4) {
            background-color: #f9a74b;
            animation-delay: 0.2s;
        }

        .loader--dot:nth-child(5) {
            background-color: #60beeb;
            animation-delay: 0.1s;
        }

        .loader--dot:nth-child(6) {
            background-color: #fbef5a;
            animation-delay: 0s;
        }

        .loader--text {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            margin: auto;
            text-align: center;

        }

        .loader--text:after {
            content: "Success..";
            font-weight: bold;
            animation-name: loading-text;
            animation-duration: 5s;
            animation-iteration-count: infinite;
        }

        @keyframes loader {
            15% {
                transform: translateX(0);
            }

            45% {
                transform: translateX(230px);
            }

            65% {
                transform: translateX(230px);
            }

            95% {
                transform: translateX(0);
            }
        }

        @keyframes loading-text {
            0% {
                content: "(ver1.1@oyiisam) Loading";
            }

            25% {
                content: "(ver1.1@oyiisam) Loading.";
            }

            50% {
                content: "(ver1.1@oyiisam) Loading..";
            }

            75% {
                content: "(ver1.1@oyiisam) Loading...";
            }
        }
    </style>
</head>

<body>
    <?= $contents; ?>
    <script>
        setTimeout(function() {
            window.location.href = "<?= base_url('AppReady') ?>";
        }, 4700);
    </script>
</body>