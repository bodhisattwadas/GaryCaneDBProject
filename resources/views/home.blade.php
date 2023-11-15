<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <title>Document</title>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Database Configuration</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('database.store') }}" method="POST">
                @csrf
                    {{-- database_tag --}}
                    <div class="form-group">
                        <label for="name">Database TAG</label>
                        <input type="text" name="db_tag" placeholder="database_tag" class="form-control">
                    </div>
                    {{-- database_description --}}
                    <div class="form-group">
                        <label for="name">Database DESCRIPTION</label>
                        <input type="text" name="db_description" placeholder="database_description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Database HOST</label>
                        <input type="text" name="db_host" placeholder="database_host" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Database NAME</label>
                        <input type="text" name="db_name" placeholder="database_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Database USER</label>
                        <input type="text" name="db_user" placeholder="database_user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Database PASSWORD</label>
                        <input type="text" name="db_password" placeholder="database_password" class="form-control">
                    </div>
                    <!-- submit button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>

</body>
</html>