@extends("layout.app")

@section("title")
	List of Contacts
@endsection

@section("content")
	<div class="container">

		<h1 class="mt-4">Contacts</h1>
		@if ($message = Session::get("success"))
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ $message }}.
		</div>
		@endif

		<div class="float-right col-lg-3 mb-3">
			<input type="text" name="search" id="search" placeholder="Search" class="form-control" />
		</div>

		<table class="table table-sm" id="dataTable">
			<thead class="thead-light">
				<tr>
					<th>NAME</th>
					<th>COMPANY</th>
					<th>PHONE</th>
					<th>EMAIL</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>

		<ul class="pagination" id="pagination"></ul>

	</div>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-body">
								Are you sure you want to delete this contact?
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
						</div>
				</div>
		</div>
	</div>
	
@endsection

@section("script")
<script>
	document.addEventListener('DOMContentLoaded', function() {
			const searchInput = document.getElementById('search');
			const dataTableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
			const pagination = document.getElementById('pagination');
    	let contactIdToDelete;

			function fetchData(query = '', page = 1) {
					const xhr = new XMLHttpRequest();
					xhr.open('POST', '{{ route('contacts.search') }}', true); 
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
					xhr.onreadystatechange = function() {
							if (xhr.readyState === 4 && xhr.status === 200) {
									const data = JSON.parse(xhr.responseText);
									populateTable(data.data);
									setupPagination(data);
							}
					};
					xhr.send('search=' + encodeURIComponent(query) + '&page=' + page);
			}

			function populateTable(data) {
					dataTableBody.innerHTML = '';
					data.forEach(item => {
							const row = dataTableBody.insertRow();
							row.insertCell(0).textContent = item.name;
							row.insertCell(1).textContent = item.company;
							row.insertCell(2).textContent = item.phone;
							row.insertCell(3).textContent = item.email;
							row.insertCell(4).innerHTML = `
                <button class="btn btn-sm btn-warning btn-edit" onclick="window.location.href='/contacts/${item.id}/edit'">Edit</button>
                <button class="btn btn-sm btn-danger btn-delete" onclick="confirmDelete(${item.id})">Delete</button>
            `;
					});
			}

			function setupPagination(data) {
        pagination.innerHTML = '';

        const currentPage = data.current_page;
        const totalPages = data.last_page;


        if (currentPage > 1) {
            const prev = document.createElement('li');
            const prevLink = document.createElement('a');
            prevLink.href = '#';
            prevLink.textContent = 'Previous';
            prevLink.addEventListener('click', function(e) {
                e.preventDefault();
                fetchData(searchInput.value, currentPage - 1);
            });
            prev.appendChild(prevLink);
            pagination.appendChild(prev);
        }

        const visibleLinks = 4;
        let startPage = Math.max(1, currentPage - Math.floor(visibleLinks / 2));
        let endPage = Math.min(totalPages, startPage + visibleLinks - 1);


        if (endPage - startPage + 1 < visibleLinks) {
            startPage = Math.max(1, endPage - visibleLinks + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#';
            a.textContent = i;
            if (i === currentPage) {
                a.classList.add('active');
            }
            a.addEventListener('click', function(e) {
                e.preventDefault();
                fetchData(searchInput.value, i);
            });
            li.appendChild(a);
            pagination.appendChild(li);
        }

        if (currentPage < totalPages) {
            const next = document.createElement('li');
            const nextLink = document.createElement('a');
            nextLink.href = '#';
            nextLink.textContent = 'Next';
            nextLink.addEventListener('click', function(e) {
                e.preventDefault();
                fetchData(searchInput.value, currentPage + 1);
            });
            next.appendChild(nextLink);
            pagination.appendChild(next);
        }
    	}

			searchInput.addEventListener('input', function() {
					const query = searchInput.value;
					fetchData(query);
			});

			fetchData();

			window.confirmDelete = function(contactId) {
        contactIdToDelete = contactId;
        $('#deleteModal').modal('show');
			};

			document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
					const xhr = new XMLHttpRequest();
					xhr.open('DELETE', `/contacts/${contactIdToDelete}`, true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
					xhr.onreadystatechange = function() {
							if (xhr.readyState === 4 && xhr.status === 204) {
									fetchData(searchInput.value);
									$('#deleteModal').modal('hide');
							}
					};
					xhr.send();
			});

			document.getElementById('cancelDeleteBtn').addEventListener('click', function() {
				$('#deleteModal').modal('hide');
			});
	});
</script>
@endsection