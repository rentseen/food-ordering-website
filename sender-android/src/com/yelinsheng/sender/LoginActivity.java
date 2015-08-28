package com.yelinsheng.sender;

import java.net.URLDecoder;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;


public class LoginActivity extends Activity {
	private Button b1;
	private TextView user,passwd,ip;
	String suser,spasswd;
	public static String sip;
	
	
	HttpClient httpclient=new DefaultHttpClient();
	private Handler mHandler = new Handler(){  
        
        public void handleMessage(Message msg) {  
               String get=(String) msg.obj;
               Intent intent = new Intent();
               intent.setClass(LoginActivity.this, SenderActivity.class);
               
               Bundle bundle = new Bundle();
               bundle.putString("mss", get);
               
               intent.putExtras(bundle);
               startActivity(intent);
        };  
    };  

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        b1= (Button) findViewById(R.id.button1);
        user=(TextView) findViewById(R.id.user);
        passwd=(TextView) findViewById(R.id.passwd);
        ip=(TextView) findViewById(R.id.ip);
        
    	b1.setOnClickListener(new OnClickListener() {
    		
    		@Override
    		public void onClick(View v) {
    			// TODO Auto-generated method stub
    			suser=user.getText().toString();
    			spasswd=passwd.getText().toString();
    			sip=ip.getText().toString();
    			new Thread()
        		{
        			public void run()
        			{
        				
        				try{ 
                			//创建连接 
        					
                			HttpClient httpClient = new DefaultHttpClient();
                			
                			HttpPost post = new HttpPost("http://"+sip+"/sender_order.php");
                			//设置参数，仿html表单提交 
                			
                			List<NameValuePair> paramList = new ArrayList<NameValuePair>(); 
                			BasicNameValuePair param1 = new BasicNameValuePair("user",suser); 
                			paramList.add(param1); 
                			BasicNameValuePair param2 = new BasicNameValuePair("passwd",spasswd); 
                			paramList.add(param2); 
                			
                			HttpEntity entity = new UrlEncodedFormEntity(paramList, HTTP.UTF_8);
                			post.setEntity(entity); 
                			//发送HttpPost请求，并返回HttpResponse对象 
                			
                			HttpResponse httpResponse = httpClient.execute(post); 
                			
                			// 判断请求响应状态码，状态码为200表示服务端成功响应了客户端的请求 
                			if(httpResponse.getStatusLine().getStatusCode() == 200){ 
                			//获取返回结果 
                			String result = EntityUtils.toString(httpResponse.getEntity());
                			Message message = new Message();
                            message.obj = result;  
                            mHandler.sendMessage(message);
                			} 
                			else{
                				Message message = new Message();
                                message.obj = "can not visit";  
                                mHandler.sendMessage(message);
                			}
                			}catch(Exception e){e.printStackTrace();} 
        			}
            		
        		}.start();
    		}
    	});
    	
    	
    	
    }
}
