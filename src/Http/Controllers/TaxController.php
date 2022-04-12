<?php

namespace StarfolkSoftware\Levy\Http\Controllers;

use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Contracts\DeletesTaxes;
use StarfolkSoftware\Levy\Contracts\UpdatesTaxes;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tax;

class TaxController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \StarfolkSoftware\Levy\Contracts\CreatesTaxes  $createsTaxes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatesTaxes $createsTaxes)
    {
        $createsTaxes(
            request()->user(),
            request()->all()
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect'),
            Levy::redirects('store', '/')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @param  \StarfolkSoftware\Levy\Contracts\UpdatesTaxes  $updatesTaxes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tax $tax, UpdatesTaxes $updatesTaxes)
    {
        $updatesTaxes(
            request()->user(),
            $tax,
            request()->all()
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect'),
            Levy::redirects('store', '/')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @param  \StarfolkSoftware\Levy\Contracts\DeletesTaxes  $deletesTaxes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tax $tax, DeletesTaxes $deletesTaxes)
    {
        $deletesTaxes(
            request()->user(),
            $tax
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect'),
            Levy::redirects('store', '/')
        );
    }
}