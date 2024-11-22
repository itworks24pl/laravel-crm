<?php

namespace VentureDrake\LaravelCrm\Console;

use Ramsey\Uuid\Uuid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Composer;
use VentureDrake\LaravelCrm\Models\Organisation;
class CrmDataMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:data-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Foundation\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach(Organisation::all() as $e){
            $e->delete();
        }
        foreach(\VentureDrake\LaravelCrm\Models\Address::all() as $e){
            print_r($e->delete());
        }
        // \VentureDrake\LaravelCrm\Models\Invoice::truncate();
        // \VentureDrake\LaravelCrm\Models\Order::truncate();
        // \VentureDrake\LaravelCrm\Models\Quote::truncate();
        // \VentureDrake\LaravelCrm\Models\Person::truncate();
        // Organisation::truncate();

        $counter = 0;
        $klienci = DB::table('napoleon.klienci')->select('*')->get();
        foreach($klienci as $klient){

            $organisation = new Organisation;
            $organisation->external_id = $klient->idklienta;
            $organisation->shortname = self::transcodeToUTF($klient->nazwa);
            $organisation->name = self::transcodeToUTF($klient->nazwa_faktura ? $klient->nazwa_faktura : $klient->nazwa);
            $organisation->vat_number = $klient->NIP;
            $organisation->save();
            $organisation->addresses()->create([
                'address_type_id' => 1,
                'external_id' => Uuid::uuid4()->toString(),
                'address' => self::transcodeToUTF($klient->nazwa_faktura_cd),
                'city' => self::transcodeToUTF($klient->nazwa_faktura_cd1),
                'addressable_id' => $organisation->id,
                'country' => 'Polska',
                'primary' => 1,
            ]);
            echo $organisation->name . "\n";
            $counter++;
            if($counter > 25){
                return;
            }
        }

    }

    public static function transcodeToUTF(string $string){
        $returnString = $string;
        $returnString = preg_replace("/xxx/","ą", $returnString);
        $returnString = preg_replace("/xxx/","Ą", $returnString);
        $returnString = preg_replace("/xxx/","ć", $returnString);
        $returnString = preg_replace("/xxx/","Ć", $returnString);
        $returnString = preg_replace("/ê/","ę", $returnString);
        $returnString = preg_replace("/xxx/","Ę", $returnString);
        $returnString = preg_replace("/³/","ł", $returnString);
        $returnString = preg_replace("/£/","Ł", $returnString);
        $returnString = preg_replace("/ñ/","ń", $returnString);
        $returnString = preg_replace("/Ñ/","Ń", $returnString);
        $returnString = preg_replace("/XXX/","ś", $returnString);
        $returnString = preg_replace("/XXX/","Ś", $returnString);
        $returnString = preg_replace("/XXX/","ó", $returnString);
        $returnString = preg_replace("/XXX/","Ó", $returnString);
        $returnString = preg_replace("/¿/","ż", $returnString);
        $returnString = preg_replace("/¯/","Ż", $returnString);
        $returnString = preg_replace("/Ÿ/","ź", $returnString);
        $returnString = preg_replace("/xxx/","Ź", $returnString);

        return $returnString;
    }
}
