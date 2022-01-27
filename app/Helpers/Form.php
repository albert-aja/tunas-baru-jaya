<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Form
{
    public static function default_form($title, $form_value, $content, $hide = 0, $info = '')
    {
        $form = '
                    <div class="form-group" ' . ($hide == 1 ? 'style="display: none;"' : '') . '>
                        <label for="' . $form_value . '" class="col-sm-2 control-label">' . $title . ' ' . $info . '</label>
                        <div class="col-sm-10">
                            ' . $content . '
                        </div>
                    </div>
                ';

        return $form;
    }

    public static function input_text($form, $title, $form_value, $placeholder, $current)
    {
        $content = '<input type="text" class="form-control" id="' . $form_value . '" name="' . $form_value . '" placeholder="' . $placeholder . '" value="' . $current . '" />';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content) : $content);

        return $input;
    }

    public static function input_text_with_front_addon($form, $title, $form_value, $placeholder, $current, $addon)
    {
        $content = '
                    <div class="input-group">
                        <span class="input-group-addon">' . $addon . '</span>
                        <input type="text" class="form-control" id="' . $form_value . '" name="' . $form_value . '" placeholder="' . $placeholder . '" value="' . $current . '" />
                    </div>
                   ';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content) : $content);

        return $input;
    }

    public static function input_readonly($form, $title, $form_value, $placeholder, $current)
    {
        $content = '<input type="text" class="form-control" id="' . $form_value . '" name="' . $form_value . '" placeholder="' . $placeholder . '" value="' . $current . '" readonly />';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content) : $content);

        return $input;
    }

    public static function input_hidden($form, $title, $form_value, $placeholder, $current)
    {
        $content = '<input type="text" class="form-control" id="' . $form_value . '" name="' . $form_value . '" placeholder="' . $placeholder . '" value="' . $current . '" />';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content, 1) : $content);

        return $input;
    }

    public static function input_date($form, $title, $form_value, $placeholder, $current)
    {
        $content = '<input type="text" class="form-control" id="' . $form_value . '" name="' . $form_value . '" data-date-format="yyyy-mm-dd" placeholder="' . $placeholder . '" value="' . $current . '" />';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content, 0) : $content);

        return $input;
    }

    public static function input_file($form, $title, $form_value, $class, $current)
    {
        $content = '
                    <input type="file" class="form-control ' . $class . '" id="' . $form_value . '" name="' . $form_value . '" />
                    <input type="hidden" class="form-control" id="' . $form_value . '_lama" name="' . $form_value . '_lama" value="' . $current . '" />
                   ';

        $info = ($current != '' ? '<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup>' : '');

        $input = ($form == 1 ? self::default_form($title, $form_value, $content, 0, $info) : $content);

        return $input;
    }

    public static function textarea($form, $title, $form_value, $placeholder, $current)
    {
        $content = '<textarea class="form-control" id="' . $form_value . '" name="' . $form_value . '" placeholder="' . $placeholder . '">' . $current . '</textarea>';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content) : $content);

        return $input;
    }

    public static function checkbox_multiple($form, $table, $id, $data, $template, $title, $form_value, $current, $where)
    {
        $checkbox_datas = DB::select(DB::raw('select * from ' . $table . ' where ' . $where . ' order by created_at'));
        $content = '';

        foreach ($checkbox_datas as $checkbox_data) {
            $text = $template;

            foreach ($data as $key => $template_data) {
                $field = $data[$key];
                $text = str_replace('$' . $key . '$', $checkbox_data->$template_data, $text);
            }

            $content .= '
                            <label style="width: 100%;">
                                <input type="checkbox" class="flat-green" value="' . $checkbox_data->$id . '" name="' . $form_value . '[]" ' . (in_array($checkbox_data->$id, $current) ? 'checked' : '') . '> ' . $text . '
                            </label>
                        ';
        }

        $input = ($form == 1 ? self::default_form($title, $form_value, $content, 0, '') : $content);

        return $input;
    }

    public static function select($form, $table, $id, $data, $template, $title, $form_value, $placeholder, $current, $where)
    {
        $option_datas = DB::select(DB::raw('select * from ' . $table . ' where ' . $where . ''));
        $content = '<select class="form-control select2" style="width: 100%;" name="' . $form_value . '" id="' . $form_value . '" data-placeholder="' . $placeholder . '"><option></option>';

        foreach ($option_datas as $option_data) {
            $text = $template;

            foreach ($data as $key => $template_data) {
                $field = $data[$key];
                $text = str_replace('$' . $key . '$', $option_data->$template_data, $text);
            }

            $content .= '<option value="' . $option_data->$id . '" ' . ($option_data->$id == $current ? 'selected' : '') . '>' . $text . '</option>';
        }

        $content .= '</select>';

        $input = ($form == 1 ? self::default_form($title, $form_value, $content, 0, '') : $content);

        return $input;
    }

    public static function form_footer($route)
    {
        $footer = '
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-sm btn-primary" id="TombolForm" name="TombolForm">Simpan</button>
                                <a href="' . $route . '" class="btn btn-sm btn-default pull-right" >Kembali</a>
                            </div>
                        </div>
                    </div>
                 ';

        return $footer;
    }
}
