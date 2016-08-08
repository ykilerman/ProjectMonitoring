package id.situmorang.projectmonitoring.projectmonitoring;

import android.content.Context;
import android.content.SharedPreferences;

/**
 * Created by Situmorang PC on 8/4/2016.
 */
public class SessionUser {

    public void setName(Context context, String name, String value) {

        SharedPreferences.Editor editor = context.getSharedPreferences("name", Context.MODE_PRIVATE).edit();
        editor.putString(name, value);
        editor.commit();

    }

    public  String getName(Context context, String name) {

        SharedPreferences prefs = context.getSharedPreferences("name",	Context.MODE_PRIVATE);
        String nma = prefs.getString(name, "");
        return nma;
    }



    public void setUsername(Context context, String username, String value) {

        SharedPreferences.Editor editor = context.getSharedPreferences("username", Context.MODE_PRIVATE).edit();
        editor.putString(username, value);
        editor.commit();

    }

    public  String getUsername(Context ctx, String username) {

        SharedPreferences prefs = ctx.getSharedPreferences("username",	Context.MODE_PRIVATE);
        String user = prefs.getString(username, "");
        return user;
    }



    public void setPosition(Context context, String position, String value) {

        SharedPreferences.Editor editor = context.getSharedPreferences("position", Context.MODE_PRIVATE).edit();
        editor.putString(position, value);
        editor.commit();

    }

    public  String getPosition(Context ctx, String position) {

        SharedPreferences prefs = ctx.getSharedPreferences("position",	Context.MODE_PRIVATE);
        String pst = prefs.getString(position, "");
        return pst;
    }
}
