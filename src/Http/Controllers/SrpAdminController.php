<?PHP

namespace Denngarr\Seat\SeatSrp\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;
use Seat\Web\Http\Controllers\Controller;
use Denngarr\Seat\SeatSrp\Models\KillMail;
use Denngarr\Seat\SeatSrp\Validation\AddReason;


class SrpAdminController extends Controller
{

    public function srpGetKillMails()
    {
        $killmails = KillMail::where('approved', '>', '-2')->orderby('created_at', 'desc')->get();

        return view('srp::list', compact('killmails'));
    }

    public function srpApprove($kill_id, $action)
    {
        $killmail = KillMail::find($kill_id);

<<<<<<< HEAD
<<<<<<< HEAD
        switch ($action) {
        $response = (new Client())->request('GET', $request->costInput);
        $costInput = json_decode($response->getBody());
=======
        // $response = (new Client())->request('GET', $request->costInput);
        // $costInput = json_decode($response->getBody());
>>>>>>> 0442143... test
=======
        $response = (new Client())->request('GET', $request->costInput);
        $costInput = json_decode($response->getBody());
>>>>>>> 5a129d3... test done

            case 'Approve':
                $killmail->approved = '1';
                break;
            case 'Reject':
                $killmail->approved = '-1';
                break;
            case 'Paid Out':
                $killmail->approved = '2';
                break;
            case 'Pending':
                $killmail->approved = '0';
                break;
        }

        $killmail->approver = auth()->user()->name;
        $killmail->cost = (double)$costInput;
        $killmail->save();

        return json_encode(['name' => $action, 'value' => $kill_id, 'approver' => auth()->user()->name]);
    }

    public function srpAddReason(AddReason $request)
    {

        $kill_id = $request->input('srpKillId');

        $killmail  = Killmail::find($kill_id);



        if (is_null($killmail))
        return redirect()->back()
            ->with('error', trans('srp::srp.not_found'));

        $reason = $killmail->reason();
        if (!is_null($reason))
            $reason->delete();

        KillMail::addNote($request->input('srpKillId'), 'reason', $request->input('srpReasonContent'));

        return redirect()->back()
                         ->with('success', trans('srp::srp.note_updated'));
    }
}
