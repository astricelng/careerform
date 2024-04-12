@php
    use Statamic\Facades\Form;

    $builder['form'] = Form::find('career');

    $entries = \Statamic\Facades\Collection::find('careers')->queryEntries()->where('published', true)->get();

    $careers = $entries->map(function ($entry) {
        return $entry
            ->toAugmentedCollection(['id', 'title', 'description', 'vacancy', 'slug'])
            ->withShallowNesting()
            ->toArray();
    });

@endphp

@extends('layout')

@section('body')
    <career v-slot="slotProps">
        <div id="career">

            <l-p-List @item-selected="slotProps.careerSelected" :has-panel="true">
                <template #items="{showMore, selectItem}">
                    <ul
                        class="grid grid-cols-1 gap-x-5 gap-y-7 md:gap-y-10 md:grid-cols-2 xl:grid-cols-3 xl:justify-items-stretch"
                    >
                        @foreach($careers as $career)
                            <li
                                class="w-full flex flex-col col-span-1 max-w-sm h-55 md:h-60 group bg-white-200 transition duration-150 ease-in-out hover:bg-blue-dark rounded-[5px] cursor-pointer text-blue-dark p-7 border border-black"

                            >
                                <div>
                                    <h1
                                        class="font-title font-medium text-lg md:text-xl leading-snug group-hover:text-white-100 uppercase transition duration-150 ease-in-out"
                                    >
                                        {{ $career['title'] }}
                                    </h1>
                                    <button
                                        class="flex leading-none underline bg-transparent group-hover:text-gray-300 mt-2.5 transition duration-150 ease-in-out"
                                        @click="{{ 'showMore('.json_encode($career).')' }}"
                                    >
                                        <span class="hover:text-white-100">Show more</span>
                                    </button>
                                    <p
                                        class="leading-none group-hover:text-white-100 mt-7 transition duration-150 ease-in-out"
                                    >
                                        {{ $career['vacancy'] }}
                                        <span> {{ $career['vacancy']->raw() < 2 ? 'vacant' : 'vacancies' }}
                                </span>
                                    </p>
                                </div>
                                <div class="flex-1 flex flex-row items-end justify-center">
                                    <div
                                        class="w-full flex flex-row items-center text-blue-dark group-hover:text-blue-light-400"
                                    >
                                        <div class="w-full h-px bg-blue-light-400"></div>
                                        <button
                                            class="min-w-23 w-full px-2 xl:px-5 hover:text-white-100 transition duration-150 ease-in-out"
                                            @click="{{ 'selectItem("'.$career['id'].'")' }}"
                                        >
                                            Apply now!
                                        </button>
                                        <div class="w-full h-px bg-blue-light-400"></div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </template>

                <template #panel="{dataPanel, panelSelectItem}">
                    <div
                        class="h-full bg-white border-l border-gray-300 pt-10 pb-36 px-5 mx:px-10 xl:pl-18 xl:pr-25"
                    >
                        <div
                            class="md:w-3/4 xl:w-full flex flex-col md:mx-auto"
                            v-if="dataPanel"
                        >
                            <h2
                                class="font-title font-medium text-4xl text-blue-dark leading-custom" v-text="dataPanel.title"
                            >
                            </h2>
                            <span class="text-blue-dark leading-none mt-5" v-text="dataPanel.vacancy < 2 ? dataPanel.vacancy+' vacant' : dataPanel.vacancy+' vacancies'">

                            </span>
                            <div class="w-full mt-15">
                                <div class="flex flex-row items-center">
									<span
                                        class="min-w-34 font-title text-blue-dark leading-none uppercase"
                                    >Job Description</span
                                    >
                                    <div
                                        class="ml-2 w-full h-px bg-blue-light-400"
                                    ></div>
                                </div>
                                <div
                                    class="mt-7 space-y-5 text-blue-dark"
                                    v-html="dataPanel.description"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full bg-white-200 border-l border-gray-300 pb-7 xl:pl-18 xl:pr-25 xl:shadow-bar-apply"
                    >
                        <button
                            type="button"
                            class="btn_apply-show w-full h-11 3xl:h-13 text-white-100 bg-blue-dark rounded-3 md:rounded-5 rounded-br-3xl md:rounded-br-4xl transition duration-300 ease-in-out hover:ring-2 hover:ring-blue-dark"
                            @click="panelSelectItem(dataPanel.id)"
                        >
                            Apply now!
                        </button>
                    </div>
                </template>
            </l-p-list>

            <career-form :career="slotProps.career">
                <main class="py-12 md:py-16 lg:py-24 stack-12 md:stack-16 lg:stack-24" id="content">
                    @if (isset($builder['form']))
                        @includeIf('page_builder._form')
                    @endif
                </main>
            </career-form>
        </div>
    </career>
@endsection
