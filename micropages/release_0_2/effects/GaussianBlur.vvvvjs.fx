#ifdef GL_ES
precision highp float;
#endif

varying vec2 vs2psTexCd;

uniform mat4 tW : WORLD;
uniform mat4 tV : VIEW;
uniform mat4 tP : PROJECTION;
uniform sampler2D Texture;
uniform sampler2D Blur_Map;
uniform float blurAmount;
uniform float width;
uniform float height;
uniform mat4 Texture_Transform;


vertex_shader{TBlurX,TBlurY}:

attribute vec3 PosO : POSITION;
attribute vec2 TexCd : TEXCOORD0;

void main(void) {

  mat4 tWV = tV * tW;
  mat4 tWVP = tP * tWV;
  
  vec2 TexCd2 = (Texture_Transform * vec4(TexCd-.5, 0, 1)).xy;
  TexCd2 += .5;
  
  vs2psTexCd = TexCd2;
  gl_Position = (tWVP * vec4(PosO, 1.0));
}

fragment_shader{TBlurX}:

void main(void) {
  
  float k[13];
  k[0] = 0.0000348;
  k[1] = 0.0005445;
  k[2] = 0.0051667;
  k[3] = 0.0297325;
  k[4] = 0.1037768;
  k[5] = 0.2196956;
  k[6] = 0.2820947;
  k[7] = 0.2196956;
  k[8] = 0.1037768;
  k[9] = 0.0297325;
  k[10] = 0.0051667;
  k[11] = 0.0005445;
  k[12] = 0.0000348;
  
  vec4 blurMapCol = texture2D(Blur_Map, vs2psTexCd);
  
  float pxOffset = 1.0/width * blurAmount * (blurMapCol.x+blurMapCol.y+blurMapCol.z)/3.0;
  
  vec4 col = vec4(0, 0, 0, 0);
  for (int i=0; i<13; i++) {
    col += texture2D(Texture, vec2(vs2psTexCd.x + float(i-6)*pxOffset, vs2psTexCd.y)) * k[i];
  }
  gl_FragColor = col;

}


fragment_shader{TBlurY}:

void main(void) {
  
  float k[13];
  k[0] = 0.0000348;
  k[1] = 0.0005445;
  k[2] = 0.0051667;
  k[3] = 0.0297325;
  k[4] = 0.1037768;
  k[5] = 0.2196956;
  k[6] = 0.2820947;
  k[7] = 0.2196956;
  k[8] = 0.1037768;
  k[9] = 0.0297325;
  k[10] = 0.0051667;
  k[11] = 0.0005445;
  k[12] = 0.0000348;
  
  vec4 blurMapCol = texture2D(Blur_Map, vs2psTexCd);
  
  float pxOffset = 1.0/width * blurAmount * (blurMapCol.x+blurMapCol.y+blurMapCol.z)/3.0;
  
  vec4 col = vec4(0, 0, 0, 0);
  for (int i=0; i<13; i++) {
    col += texture2D(Texture, vec2(vs2psTexCd.x, vs2psTexCd.y + float(i-6)*pxOffset)) * k[i];
  }
  gl_FragColor = col;

}