<?php

namespace App\Jobs;

use App\Models\ListingImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     private $listing_image_id;

    public function __construct($listing_image_id)
    {
        $this->listing_image_id = $listing_image_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $i = ListingImage::find($this->listing_image_id);

        if (!$i) {
            return;
        }

        $image = file_get_contents(storage_path("/app/public/" . $i->file));

        putenv("GOOGLE_APPLICATION_CREDENTIALS=" . base_path("google_credential.json"));
       
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();

        if ($labels) {

            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }

            // echo json_encode($result);
            $i->labels = $result;
            $i->save();
        }

        $imageAnnotator->close();
       
    }
}
