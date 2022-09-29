<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading"><h2>Form</h2></div>
        <div class="panel-body">

            <form action="{{ $url }}/{{ $formAttr['key']}}" method="POST" enctype="multipart/form-data">
                <div class="row">

{{--                    <input type="hidden" name="key" value="{{ $formAttr['key']}}" />--}}
                    <input type="hidden" name="x-amz-algorithm" value="{{ $formAttr['X-Amz-Algorithm']}}" />
                    <input type="hidden" name="x-amz-credential" value="{{ $formAttr['X-Amz-Credential']}}" />
                    <input type="hidden" name="x-amz-date" value="{{$formAttr['X-Amz-Date']}}" />
                    <input type="hidden" name="policy" value="{{$formAttr['Policy']}}" />
                    <input type="hidden" name="x-amz-signature" value="{{$formAttr['X-Amz-Signature']}}" />
                    <input type="hidden" name="X-Amz-Security-Token" value="{{$formAttr['X-Amz-Security-Token']}}" />

                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
</body>

</html>
