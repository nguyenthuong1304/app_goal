<div class="card mb-4 sidebar-content">
    <div class="card-header text-center"><i class="fas fa-tags mr-2"></i>{{ __('common.main_tag') }}</div>
    <div class="card-body main-tag-list py-3 mx-auto">
        <a href="{{
            \App\Models\Tag::where('name', 'status')->first()
            ? route('tags.show', ['name' => 'status'])
            : ''
        }}">
            <p>#status</p>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'family')->first()
            ? route('tags.show', ['name' => 'family'])
            : ''
        }}">
            <p>#family</p>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'health')->first()
            ? route('tags.show', ['name' => 'health'])
            : ''
        }}">
            <p>#health</p>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'reflection/awareness')->first()
            ? route('tags.show', ['name' => 'reflection/awareness'])
            : ''
        }}">
            <p>#reflection/awareness</p>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'question')->first()
            ? route('tags.show', ['name' => 'question'])
            : ''
        }}">
            <p>#question</p>
        </a>
    </div>
</div>
