<h3 class="mb-2"><i class="ml-2 fas fa-ticket"></i></h3>

<form action="{{ route('profile.tickets.new') }}" method="POST">
    {{ csrf_field()  }}
    <div class="form-group">
        <label for="title">Ticket title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="title" placeholder="Enter ticket title">
    </div>
    <div class="form-group py-2">
        <label for="text">Ticket message</label>
        <textarea class="form-control" name="message" id="title" rows="5" placeholder="Enter ticket content"></textarea>
    </div>

    <div class="form-group text-right py-2">
        <button type="submit" class="btn btn-primary">
            <i class="ml-2 fas fa-ticket"></i> Open ticket
        </button>
    </div>
</form>

