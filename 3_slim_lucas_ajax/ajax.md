

---
html: fetch('/calculate'
```
        function sendRequest() {
            const n = document.getElementById('inputN').value;
            fetch('/calculate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ n })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('result').innerText = `Lucas Number L${n} = ${data.result}`;
                    document.getElementById('time').innerText = `Time: ${(data.process_time).toFixed(3)} msec`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });

```
---
php: post('/calculate'
```
$app->post('/calculate', function (Request $request, Response $response, $args) {
    $data = json_decode($request->getBody(), true);
    $n = intval($data['n']);

    $start_time = microtime(true);
    $result = calculateLucas($n);
    $end_time = microtime(true);
    $process_time = ($end_time - $start_time) * 1000; // ミリ秒に変換

    $response->getBody()->write(json_encode([
        'result' => $result,
        'process_time' => $process_time
    ]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
```
---
