<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
 

// file TraitSave
private function insertSlug($com = '', $act = '', $type = '', $id = 0, $dataSlug = array(), $controller = ''): void
{
    SlugModel::where('id_parent', $id)->where('com', $com)->where('type', $type)->where('act', $act)->delete();
    if (!empty($controller)) {
        $dataSlug['controller'] = $controller;
    } else {
        $dataSlug['controller'] = '\\' . str_replace('Admin', 'Web', get_class($this));
    }

    $dataSlug['model'] = convertToModelClass($com);
    $dataSlug['id_parent'] = $id;
    $dataSlug['com'] = $com;
    $dataSlug['act'] = $act;
    $dataSlug['type'] = $type;
    SlugModel::create($dataSlug);
    Func::writeJson();
} 

// file APIcontroller
public function copy(Request $request)
{

    $dataCopy = array();
    $dataSlug = array();
    $table = (!empty($request->table)) ? trim(htmlspecialchars($request->table)) : '';
    $id = (!empty($request->id)) ? trim(htmlspecialchars($request->id)) : 0;
    $com = (!empty($request->com)) ? trim(htmlspecialchars($request->com)) : '';
    $type = (!empty($request->type)) ? trim(htmlspecialchars($request->type)) : '';
    $row = DB::table($table)->select('*')->where('id', $id)->first();
   
    $slugcopy = SlugModel::select('id', 'controller')->where('id_parent', $id)->orderBy('id', 'desc')->first();


    if (!empty($row)) {
        $row = get_object_vars($row);

        foreach (config('app.langs') as $k => $v) {
            $dataCopy['name' . $k] = $row['name' . $k] . '-' . $row['id'] + 1;
            $dataCopy['slug' . $k] = $row['slug' . $k] . '-' . $row['id'] + 1;
            if (!empty($row['desc' . $k])) {
                $dataCopy['desc' . $k] = $row['desc' . $k];
            }
        }
        if (!empty($row['id_list'])) {
            $dataCopy['id_list'] = $row['id_list'];
        }
        if (!empty($row['id_cat'])) {
            $dataCopy['id_cat'] = $row['id_cat'];
        }
        if (!empty($row['id_item'])) {
            $dataCopy['id_item'] = $row['id_item'];
        }
        if (!empty($row['id_sub'])) {
            $dataCopy['id_sub'] = $row['id_sub'];
        }

        if (!empty($row['photo'])) {
            $dataCopy['photo'] = Func::copyImg($row['photo'], $table);
        }

        $dataCopy['date_created'] = time();
        $dataCopy['type'] = $row['type'];
        $dataCopy['numb'] = $row['numb'];

        $checkCopy = DB::table($table)->insert($dataCopy);

        if (!empty($checkCopy)) {
            $rowSlug = DB::table($table)->select('*')->orderBy('id', 'desc')->first();
            $rowSlug = get_object_vars($rowSlug);
            $id = $rowSlug['id'];
            $act = 'save';
            foreach (config('app.langs') as $k => $v) {
                $dataSlug['slug' . $k] = $rowSlug['slug' . $k];
            }
            $this->insertSlug($com, $act, $type, $id, $dataSlug, $slugcopy['controller']);
        }
    }
}