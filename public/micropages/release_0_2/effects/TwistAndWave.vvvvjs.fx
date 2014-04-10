#ifdef GL_ES
precision highp float;
#endif

uniform mat4 tW : WORLD;
uniform mat4 tV : VIEW;
uniform mat4 tP : PROJECTION;

uniform mat4 Pre_Transform;

uniform vec3 Light_Direction_XYZ = {0.0, -5.0, 2.0};
uniform vec4 Ambient_Color : COLOR = {0.15, 0.15, 0.15, 1.0};
uniform vec4 Diffuse_Color : COLOR = {0.85, 0.85, 0.85, 1.0};
uniform vec4 Specular_Color : COLOR = {0.35, 0.35, 0.35, 1.0};
uniform float Power = 25.0;
uniform sampler2D Texture;
uniform mat4 Texture_Transform;
uniform float Alpha = 1.0;

uniform float Twist_Frequency = 1.0;
uniform float X_Wave_Frequency = 1.0;
uniform float X_Wave_Amplitude = 1.0;
uniform float Z_Wave_Frequency = 1.0;
uniform float Z_Wave_Amplitude = 1.0;

uniform float Near = 0.0;
uniform float Far = 100.0;
uniform float Reference_Depth = 0.0;

varying float vs2psValue;

varying vec2 vs2psTexCd;
varying vec3 LightDirV;
varying vec3 NormV;
varying vec3 ViewDirV;

vertex_shader{TPhongDirectional,TDepthOffset}:

attribute vec3 PosO : POSITION;
attribute vec2 TexCd : TEXCOORD0;
attribute vec3 NormO : NORMAL;

void main(void) {

  mat4 tWV = tV * tW;
  mat4 tWVP = tP * tWV;
  
  LightDirV = normalize(-1.0*(tV*vec4(Light_Direction_XYZ,1))).xyz;
  NormV = normalize(Pre_Transform * tWV * vec4(NormO, 0)).xyz;
  
  vec4 xformedPos = Pre_Transform * vec4(PosO, 1);
  float dist = distance(vec2(0,0), xformedPos.xz);
  float angle = atan(xformedPos.z, xformedPos.x) + xformedPos.y * Twist_Frequency * 3.14 * 2.0;
  xformedPos.x = cos(angle) * dist;
  xformedPos.z = sin(angle) * dist;
  
  xformedPos.x += sin(xformedPos.y * X_Wave_Frequency) * X_Wave_Amplitude;
  xformedPos.z += sin(xformedPos.y * Z_Wave_Frequency) * Z_Wave_Amplitude;
  
  vec4 PosV = tWV * xformedPos;
  ViewDirV = normalize(-PosV).xyz;

  gl_Position = (tWVP * xformedPos);
  vs2psTexCd = (Texture_Transform * vec4(TexCd, 0, 1)).xy;
  vs2psValue = min(1.0, abs(PosV.z - Reference_Depth) / (Far - Near)); 
}

fragment_shader{TPhongDirectional}:

void main(void) {
  vec3 H = normalize(ViewDirV + LightDirV);
  
  vec4 diff = Diffuse_Color * max(dot(NormV, LightDirV), 0.0);
  
  //reflection vector (view space)
  vec3 R = normalize(2.0 * dot(NormV, LightDirV) * NormV - LightDirV);
  vec3 V = normalize(ViewDirV);
  
  vec4 spec = Specular_Color * pow(max(dot(R, V),0.0), Power*.2);

  gl_FragColor = texture2D(Texture, vs2psTexCd);
  gl_FragColor.rgb *= Ambient_Color.rgb + diff.rgb + spec.rgb;
  gl_FragColor.a *= Alpha;
}


fragment_shader{TDepthOffset}:

void main(void) {
  gl_FragColor = vec4(vs2psValue, vs2psValue, vs2psValue, 1.0);

}