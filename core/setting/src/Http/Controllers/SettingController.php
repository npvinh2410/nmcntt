<?php


namespace Hydrogen\Setting\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Setting\Repositories\Eloquent\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {

        $settings = $this->settingRepository->all();
        $list_setting = [];

        foreach ($settings as $setting)
        {
            $list_setting[$setting->key] = $setting->value;
        }

        return view('setting::index', ['settings' => $list_setting]);

    }

    public function update(Request $request)
    {
        $setting = $this->settingRepository->findByField('key', $request->input('key'))->first();
        if($setting != null)
        {
            $setting->value = $request->input('value');
            $setting->save();
        }
        else
        {
            if($request->input('value'))
            {
                $this->settingRepository->create(['key' => $request->input('key'), 'value' => $request->input('value')]);
            }
        }

        return 1;
    }
}