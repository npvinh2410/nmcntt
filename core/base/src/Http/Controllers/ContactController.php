<?php


namespace Hydrogen\Base\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Base\Models\Contact;
use Hydrogen\Base\Notifications\NewContactNotification;
use Hydrogen\Base\Repositories\Eloquent\User\UserRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        hydrogen_authorize('contacts-index');

        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('dashboard::contact.index', ['contacts' => $contacts]);
    }

    public function create(Request $request)
    {
//        if($request->input('g-recaptcha-response'))
//        {
//            $secret = "6LcCL1gUAAAAAH_9nFVVt43Fsw1mLwQCU86wuz5L";
//            $remoteip = \Illuminate\Support\Facades\Request::ip();
//            $response = $request->input('g-recaptcha-response');
//
//            $rp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
//
//            $rp = json_decode($rp, true);
//
//            if ($rp['success'] == true)
//            {
                $contact = new Contact;

                $contact->name = $request->name;
                $contact->phone = $request->phone;
                $contact->mail = $request->mail;
                $contact->note = $request->note;

                $contact->save();

                $users = $this->userRepository->all();
                $when = Carbon::now()->addMinutes(1);



                foreach ($users as $user)
                {
                    if($user->can(['contacts-show']))
                    {
                        $user->notify((new NewContactNotification($contact))->delay($when));
                    }
                }

                Session::flash('flash', 'Gửi thông tin Thành Công, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất..');
                return redirect()->back();
//            }
//        }
//        else
//        {
//            Session::flash('flash', 'Vui lòng xác nhận không là robot.');
//            return redirect()->back();
//        }


    }

    public function show($id)
    {
        $contact = Contact::find($id);

        return view('dashboard::contact.show', ['contact' => $contact]);
    }

    public function destroy(Request $request, $id)
    {
        $contact = Contact::find($id);

        $contact->delete();

        Session::flash('flash', ['success' => 'Contact deleted successfully']);
        return redirect()->route('contacts.index');
    }
}