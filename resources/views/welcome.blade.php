<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div>
            <button type="button" id="startStreamButton">
                Click me
            </button>

            <div id="streamedResponseContainer"></div>
        </div>

        <script>
            const startStreamButton = document.getElementById('startStreamButton');
            const streamedResponseContainer = document.getElementById('streamedResponseContainer');

            startStreamButton.addEventListener('click', async () => {
                fetch('/stream').then(response => {
                    const reader = response.body.getReader()
                    const decoder = new TextDecoder()

                    const read = () => {
                        reader.read().then(({ done, value }) => {
                            if (done) {
                                return
                            }

                            streamedResponseContainer.innerHTML += decoder.decode(value)

                            read()
                        })
                    }

                    read()
                })
            });
        </script>
    </body>
</html>
