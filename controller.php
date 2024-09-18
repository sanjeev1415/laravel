// CONTROLLER //

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\talent_files;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class talentcontroller extends Controller
{
    public function index()
    {
        return response()->json(talent_files::all());
    }

    public function store(Request $request)
    {
        try {



            $file = $request->file('file');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move(public_path('/files'), $filename);



            $cv = $request->file('cv');
            $extenstion = $cv->getClientOriginalExtension();
            $cvfilename = time() . '.' . $extenstion;
            $cv->move(public_path('/files'), $cvfilename);



            $talentFile = talent_files::create([
                'file' => $filename,
                'cv' => $cvfilename,
            ]);

            return response()->json($talentFile, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        // Find the talent file record or fail with a 404 error if not found
        $talentFile = talent_files::findOrFail($id);

        // Define the file paths
        $filePath = public_path('files/' . $talentFile->file);
        $cvPath = public_path('files/' . $talentFile->cv);

        // Delete the file from the public/files directory if it exists
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the CV from the public/files directory if it exists
        if (file_exists($cvPath)) {
            unlink($cvPath);
        }

        // Delete the record from the database
        $talentFile->delete();

        // Return a response indicating successful deletion
        return response()->json(['message' => 'Files Deleted Sucessfully'], 200);
    }


    public function show($id)
    {
        $files = talent_files::find($id);

        if (!$files) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($files, 200);
    }


    public function update(Request $request, $id)
    {
        try {
            $career = talent_files::find($id);




            $career->file = $career->file;
            $career->cv = $career->cv;


            $path = public_path() . '/files';


            if ($request->hasfile('file')) {

                if ($career->file != ''  && $career->file != null) {
                    $file_old = $path . $career->file;
                    unlink($file_old);
                }
                $file = $request->file('file');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move(public_path('/files'), $filename);
                $career->file = $filename;
            }



            if ($request->hasfile('cv')) {

                if ($career->cv != ''  && $career->cv != null) {
                    $file_old = $path . $career->cv;
                    unlink($file_old);
                }
                $cvfile = $request->file('cv');
                $extenstion = $file->getClientOriginalExtension();
                $cvfilename = time() . '.' . $extenstion;
                $cvfile->move(public_path('/files'), $cvfilename);
                $career->cv = $cvfilename;
            }


            //for update in table
            $career->update();
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($career);
    }
}
?>