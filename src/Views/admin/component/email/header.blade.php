<tr>
    <td align="center"
        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
        valign="top">
        <table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
            <tbody>
                <td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
                    <table cellpadding="0" cellspacing="0"
                        style="border-bottom:3px solid #ddd;padding:10px 0px;background-color:#fff" width="100%">
                        <tbody>
                            <tr>
                                <td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
                                    <table style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="" style="display:block;margin-left:20px;"
                                                        target="_blank">
                                                        <img src="{{ upload('photo', $logo['photo']) }}" alt="logo"
                                                            title="logo" width="70" />
                                                    </a>
                                                </td>
                                                <td style="text-align:right">
                                                    <div style="margin-right:20px;">
                                                        @foreach ($social as $value)
                                                            <a href="{{ $value['link'] }}">
                                                                <img src="{{ upload('photo', $value['photo']) }}"
                                                                    alt="Social" title="Social" width="30" />
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tbody>
        </table>
    </td>
</tr>
