<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\Support\Renderable;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @throws Exception
     */
    public function generateQrCodeFromExcelFile()
    {

        $file = request()->file('file');
        // read file as excel file using maatwebsite/excel package


        $reader = new Xlsx();

        $spreadsheet = $reader->load($file->getRealPath());

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // loop through the rows
        foreach ($sheetData as $row) {
            // get the value of the first column
            $value = $row['A'];
            // get the value of the second column
            $value2 = $row['B'];
            // generate the QR code with the value of the first column as the text and the value of the second
            // add text below the QR code with the value of the second column
            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd(),
            );
            $writer = new Writer($renderer);
            // Define the text to add
            $text = $value;
            $cleanedName = preg_replace('/[^A-Za-z0-9\-]/', '', $value);
            $public_path = public_path('qrcodes/' . $cleanedName . '.png');
            $writer->writeFile($value2, $public_path);
//            get the stored image and add text to the center of the image
            $image = imagecreatefrompng($public_path);


// Define the font size and color
            $fontSize = 16;
            $fontColor = imagecolorallocate($image, 0, 0, 0); // White

// Define the position and size of the text
            $textX = 10;
            $textY = imagesy($image) - 30;
            $textWidth = imagesx($image) - 20;
            $font = public_path('fonts/Roboto-Regular.ttf');
// Add the text to the image
            imagettftext($image, $fontSize, 0, $textX, $textY, $fontColor, $font, $text);

// Save the image with text to file
            imagepng($image, $public_path);

// Free up memory
            imagedestroy($image);

        }

    }
}
