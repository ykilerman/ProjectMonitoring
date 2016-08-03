package id.situmorang.projectmonitoring.projectmonitoring;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

public class KoneksiSingleton {

    private static KoneksiSingleton mInstance;
    private RequestQueue requestQueue;
    private static Context ctx;

    private KoneksiSingleton(Context context){
        ctx = context;
        requestQueue = getRequestQueue();
    }

    public RequestQueue getRequestQueue(){
        if (requestQueue==null){
            requestQueue = Volley.newRequestQueue(ctx.getApplicationContext());
        }
        return requestQueue;
    }

    public static synchronized KoneksiSingleton getmInstance(Context context){
        if (mInstance==null){
            mInstance = new KoneksiSingleton(context);
        }
        return mInstance;
    }

    public <T> void addToRequestQue(Request<T> request){
        requestQueue.add(request);
    }

}