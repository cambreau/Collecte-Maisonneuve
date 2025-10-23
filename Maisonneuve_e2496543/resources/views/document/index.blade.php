@extends('layouts.app')
@section('title', __('Document'))
@section('content')
    <h2>@lang('Document')</h2>
    
    @auth
        <div class="actions-document"></div></div>
            <a href="{{ route('document.create') }}" class="btn btn-primaire">@lang('Upload Document')</a>
        </div>
    @endauth

    <div class="conteneur-tableau-document">
        <table class="tableau-document">
            <thead>
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Author')</th>
                    <th>@lang('Type')</th>
                    <th>@lang('Size')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $document)
                    <tr>
                        <td>
                            @if(app()->getLocale() == 'fr')
                                {{ $document->titre['fr'] ?? $document->titre['en'] }}
                            @else
                                {{ $document->titre['en'] ?? $document->titre['fr'] }}
                            @endif
                        </td>
                        <td>{{ $document->etudiant->nom }}</td>
                        <td>{{ strtoupper($document->type_fichier) }}</td>
                        <td>{{ $document->formatted_size }}</td>
                        <td>{{ $document->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="actions-tableau">
                                <a href="{{ route('document.download', $document) }}" class="btn btn-secondaire btn-sm">
                                    @lang('Download')
                                </a>
                                @auth
                                    @if($document->canBeModifiedBy(Auth::user()->etudiant->id))
                                        <a href="{{ route('document.edit', $document) }}" class="btn btn-secondaire btn-sm">
                                            @lang('Edit')
                                        </a>
                                        <form action="{{ route('document.destroy', $document) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                @lang('Delete')
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="message-vide">@lang('No documents available')</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-document">
        {{ $documents->links() }}
    </div>
@endsection
