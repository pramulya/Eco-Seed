
<div class="button-group" style="gap: 10px; display: flex; margin-bottom: 10px;">
    <a href="{{ route('campaigns.create') }}" class="btn btn-success me-2">Create your own Campaign</a>
</div>

<!-- For each campaign in the loop -->
<div class="button-group" style="gap: 10px; display: flex; margin-top: 10px;">
    <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-primary me-2">Edit</a>
    
    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="margin: 0;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger me-2">Delete</button>
    </form>
    
    <a href="{{ route('campaigns.donate', $campaign->id) }}" class="btn btn-success">Donate Now</a>
</div>
