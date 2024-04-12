<div class="card flex-fill">
    <div class="card-header">
        <h5 class="mb-0 h4 text-center fw-bold">Available Records</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>Reg.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Batch</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableFilter">
                @foreach ($volunteers as $v)
                    <tr>
                        <td>{{ $v['id'] }}</td>
                        <td>{{ $v['name'] }}</td>
                        <td>{{ $v['email'] }}</td>
                        <td>{{ $v['phone'] }}</td>
                        <td>{{ $v['course'] }}</td>
                        <td>{{ $v['batch'] }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#viewDetailsModal" class="collapse-a"
                                onclick="viewInfoModalInit({{ $v['id'] }})">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col px-4 mb-3">
            Showing {{ $volunteers->firstItem() }} to {{ $volunteers->lastItem() }} of
            {{ $volunteers->total() }} entries
        </div>
        <div class="col d-flex justify-content-end">
            <span class="mx-2">{{ $volunteers->links() }}</span>
        </div>
    </div>
</div>
