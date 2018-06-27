    <style>
        .shadow {
            box-shadow: 0px 0px 20px 0px rgb(128, 128, 128);
        }

        * {
            box-sizing: border-box;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .selectable {
            -webkit-touch-callout: inherit;
            -webkit-user-select: text;
            -khtml-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Style the side navigation */
        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(165, 165, 165);
            overflow-x: hidden;
        }


            /* Side navigation links */
            .sidenav a {
                color: white;
                padding: 16px;
                text-decoration: none;
                display: block;
            }

                /* Change color on hover */
                .sidenav a:hover {
                    box-shadow: -5px 5px 13px 5px rgb(128, 128, 128);
                    text-shadow: 0px 0px 10px rgb(165, 165, 165);
                    background-color: white;
                    color: black;
                }

        /* Style the content */
        .content {
            margin-left: 220px;
            padding-left: 20px;
        }
    </style>