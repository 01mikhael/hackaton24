<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Task Status</h1>
            <h2 class="subtitle">URL: <?= $task['url'] ?> | Status: <?= $task['status'] ?> </h2>

            <div id="statuses">
                <article class="message is-info">
                    <div class="message-body">
                        Loading statuses...
                    </div>
                </article>
            </div>
        </div>
    </section>

    <script>
        const taskId = <?= $task['id'] ?>;
        const statusesDiv = document.getElementById('statuses');

        function fetchStatuses() {
            axios.get(`<?= site_url('scan/get_statuses/') ?>${taskId}`)
                .then(response => {
                    const statuses = response.data;

                    // Clear the statuses div
                    statusesDiv.innerHTML = '';

                    if (statuses.error) {
                        statusesDiv.innerHTML = `<article class="message is-danger">
                            <div class="message-body">${statuses.error}</div>
                        </article>`;
                        return;
                    }

                    // Populate the statuses
                    statuses.forEach(status => {
                        const statusElement = document.createElement('article');
                        statusElement.classList.add('message', 'is-primary');
                        statusElement.innerHTML = `<div class="message-body">
                            <strong>${status.status}</strong> - ${new Date(status.created_at).toLocaleString()}
                        </div>`;
                        statusesDiv.appendChild(statusElement);
                    });
                })
                .catch(error => {
                    statusesDiv.innerHTML = `<article class="message is-danger">
                        <div class="message-body">Error loading statuses.</div>
                    </article>`;
                    console.error(error);
                });
        }

        // Fetch statuses every 0.5 seconds
        setInterval(fetchStatuses, 500);
        fetchStatuses();
    </script>
</body>
</html>
