@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">

                    <form>
                        <div class="form-group">
                            <label for="file-name">File Name</label>
                            <input type="text" class="form-control" id="file-name" placeholder="File name">
                            <small id="file-name-help" class="form-text text-muted">if you want to put the name in the file that will be downloaded (put here)</small>
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" placeholder="Link">
                        </div>

                        <button id="download" type="button" class="btn btn-primary">Download</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Files</div>

                <div class="panel-body">

                    <table id="file-tables" class="table table-bordered">


                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"colspan="3">Files</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody id="file-tables-tbody" >
                            
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/home.js"></script>


@endsection