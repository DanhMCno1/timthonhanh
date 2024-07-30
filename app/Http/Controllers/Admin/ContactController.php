<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    protected ContactRepositoryInterface $contactRepo;

    public function __construct(ContactRepositoryInterface $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function index(Request $request): View
    {
        $contacts = $this->contactRepo->getContact($request->get('search'), $request->get('column'));

        return view('admins.contact', compact('contacts'));
    }

    public function update(Contact $contact)
    {
        $this->contactRepo->update($contact->id, [
            'status' => true
        ]);

        return redirect()->back()->with('success', `Hoàn thành xử lý thông tin liên hệ #{$contact->id}`);
    }
}
