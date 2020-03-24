<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'E15 Project 2')</title>
    <meta charset='utf-8'>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/styles.css' rel='stylesheet'>

    @yield('head')
</head>

<body>
    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; E15 Project 2
    </footer>

</body>

</html>