<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Keranjang | GameVault</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config={theme:{extend:{fontFamily:{sans:['Poppins','sans-serif']}}}}</script>
<style>
.bg-noise{background-image:radial-gradient(rgba(255,255,255,.025) .8px,transparent .8px);background-size:18px 18px}
@keyframes smoke-a{0%{transform:translate(0,0) scale(1);opacity:.5}50%{transform:translate(-30px,-20px) scale(1.1);opacity:.3}100%{transform:translate(0,0) scale(1);opacity:.5}}
@keyframes slide-fog{0%{background-position:0 0}100%{background-position:-200vw 0}}
.smoke-a{animation:smoke-a 14s ease-in-out infinite}
.fog1{position:absolute;top:0;left:0;width:300%;height:100%;background-image:url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog1.png');background-repeat:repeat-x;background-size:cover;opacity:.9;filter:brightness(1.2) contrast(1.2);animation:slide-fog 60s linear infinite;mix-blend-mode:screen}
.fog2{position:absolute;top:0;left:0;width:300%;height:100%;background-image:url('https://raw.githubusercontent.com/danielstuart14/CSS_FOG_ANIMATION/master/fog2.png');background-repeat:repeat-x;background-size:cover;opacity:.8;filter:brightness(1.2) contrast(1.2);animation:slide-fog 40s linear infinite;mix-blend-mode:screen}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
.fade-up{animation:fadeUp .3s ease forwards}
@keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
.bounce{animation:bounce 2.5s ease-in-out infinite}
.btn-grad{background:linear-gradient(135deg,#3b82f6,#8b5cf6);transition:all .2s;position:relative;overflow:hidden}
.btn-grad::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,#60a5fa,#a78bfa);opacity:0;transition:opacity .2s}
.btn-grad:hover::after{opacity:1}
.btn-grad span{position:relative;z-index:1}
/* Custom checkbox */
.item-check{appearance:none;width:20px;height:20px;border:2px solid rgba(255,255,255,.2);border-radius:6px;cursor:pointer;position:relative;flex-shrink:0;transition:all .15s}
.item-check:checked{background:linear-gradient(135deg,#3b82f6,#8b5cf6);border-color:transparent}
.item-check:checked::after{content:'✓';position:absolute;color:#fff;font-size:13px;font-weight:900;top:50%;left:50%;transform:translate(-50%,-50%)}
.item-check:hover:not(:checked){border-color:rgba(255,255,255,.5)}
.card-item{transition:border-color .2s,background .2s}
.card-item.checked{border-color:rgba(59,130,246,.5)!important;background:rgba(59,130,246,.06)!important}
/* Step dots */
.step-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;transition:all .3s}
.step-dot.active{background:linear-gradient(135deg,#3b82f6,#8b5cf6);color:#fff}
.step-dot.done{background:#22c55e;color:#fff}
.step-dot.inactive{background:rgba(255,255,255,.08);color:#6b7280}
</style>
</head>
<body class="min-h-screen bg-[#344050] text-white font-sans overflow-x-hidden">
<div class="relative min-h-screen bg-[#344050] bg-noise overflow-hidden flex flex-col">

{{-- BG --}}
<div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
  <div class="fog1"></div><div class="fog2"></div>
  <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
  <div class="smoke-a absolute top-[-5%] left-[-20%] w-[80vw] h-[70vw] max-w-[900px] max-h-[800px] rounded-full bg-slate-500/15 blur-[120px]"></div>
  <div class="smoke-a absolute top-[30%] right-[-20%] w-[70vw] h-[60vw] max-w-[800px] max-h-[700px] rounded-full bg-slate-400/10 blur-[130px]"></div>
</div>

@include('partials.navbar')

<div class="relative z-10 flex-1 max-w-[780px] mx-auto w-full px-4 pt-28 pb-36">

  {{-- Header --}}
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ url('/') }}" class="p-2 rounded-xl hover:bg-white/5 transition-colors text-gray-400 hover:text-white">
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <div>
      <h1 class="text-2xl font-black text-white tracking-tight">Keranjang Belanja</h1>
      <p id="cart-subtitle" class="text-gray-400 text-sm mt-0.5">Memuat...</p>
    </div>
  </div>

  {{-- Select All bar --}}
  <div id="select-bar" class="hidden mb-4 flex items-center gap-3 bg-[#252d40]/80 backdrop-blur-md border border-white/8 rounded-2xl px-4 py-3">
    <input type="checkbox" id="check-all" class="item-check" onchange="toggleAll(this)">
    <label for="check-all" class="text-white text-sm font-semibold cursor-pointer select-none flex-1">Pilih Semua</label>
    <button onclick="deleteSelected()" class="text-red-400 hover:text-red-300 text-xs font-semibold transition-colors flex items-center gap-1.5">
      <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
      Hapus Dipilih
    </button>
  </div>

  {{-- Items --}}
  <div id="cart-list" class="space-y-3"></div>

</div>

@include('partials.footer')
</div>

{{-- Sticky Bottom Bar --}}
<div id="bottom-bar" class="hidden fixed bottom-0 left-0 w-full z-[80]">
  <div class="bg-[#1e2433]/95 backdrop-blur-xl border-t border-white/10 shadow-[0_-8px_40px_rgba(0,0,0,0.7)]">
    <div class="max-w-[780px] mx-auto px-4 py-3.5 flex items-center gap-4">
      <div class="flex items-center gap-2.5 flex-1 min-w-0">
        <input type="checkbox" id="check-all-bar" class="item-check" onchange="toggleAll(this)">
        <div class="min-w-0">
          <p id="bar-count" class="text-gray-400 text-xs">0 item dipilih</p>
          <p id="bar-total" class="text-white font-black text-lg leading-tight">Rp 0</p>
        </div>
      </div>
      <button onclick="openPayModal()" id="btn-pay"
        class="btn-grad px-7 py-3 rounded-xl text-white font-black text-sm flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed" disabled>
        <span>Bayar</span>
        <svg class="w-4 h-4 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
      </button>
    </div>
  </div>
</div>

{{-- Toast --}}
<div id="toast" class="hidden fixed top-20 left-1/2 -translate-x-1/2 z-[120]">
  <div class="bg-[#252d40] border border-white/10 rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-xl backdrop-blur-md flex items-center gap-2">
    <span id="ti"></span><span id="tm"></span>
  </div>
</div>

{{-- MODAL --}}
<div id="modal" class="hidden fixed inset-0 z-[110] items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal()"></div>
  <div class="relative w-full max-w-md bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,.8)] overflow-hidden" style="animation:fadeUp .25s ease">
    <div class="h-1 w-full" style="background:linear-gradient(90deg,#3b82f6,#8b5cf6,#ec4899)"></div>
    <div class="p-6">
      {{-- Step indicator --}}
      <div class="flex items-center justify-center gap-2 mb-6">
        <div id="step1-dot" class="step-dot active">1</div>
        <div class="h-px w-10 bg-white/10"></div>
        <div id="step2-dot" class="step-dot inactive">2</div>
      </div>

      {{-- STEP 1: Payment --}}
      <div id="step1">
        <h3 class="text-white font-black text-lg mb-1">Metode Pembayaran</h3>
        <p class="text-gray-500 text-xs mb-5">Pilih cara pembayaran yang kamu inginkan</p>
        <div class="space-y-3" id="pay-options">
          <label class="pay-opt flex items-center gap-4 bg-[#252d40] border border-white/8 rounded-xl p-3.5 cursor-pointer hover:border-cyan-500/40 transition-all">
            <input type="radio" name="pay" value="QRIS" class="accent-cyan-400 w-4 h-4 flex-shrink-0">
            <div class="flex-1"><p class="text-white font-bold text-sm">QRIS</p><p class="text-gray-500 text-xs">Gopay, OVO, Dana, LinkAja</p></div>
            <span class="text-[10px] font-bold text-cyan-400 border border-cyan-500/30 rounded-full px-2 py-0.5">REKOMENDASI</span>
          </label>
          <label class="pay-opt flex items-center gap-4 bg-[#252d40] border border-white/8 rounded-xl p-3.5 cursor-pointer hover:border-cyan-500/40 transition-all">
            <input type="radio" name="pay" value="GoPay" class="accent-cyan-400 w-4 h-4 flex-shrink-0">
            <div class="flex-1"><p class="text-white font-bold text-sm">GoPay</p><p class="text-gray-500 text-xs">Bayar via aplikasi Gojek</p></div>
          </label>
          <label class="pay-opt flex items-center gap-4 bg-[#252d40] border border-white/8 rounded-xl p-3.5 cursor-pointer hover:border-cyan-500/40 transition-all">
            <input type="radio" name="pay" value="DANA" class="accent-cyan-400 w-4 h-4 flex-shrink-0">
            <div class="flex-1"><p class="text-white font-bold text-sm">DANA</p><p class="text-gray-500 text-xs">Bayar via DANA</p></div>
          </label>
        </div>
        <button onclick="goStep2()" class="btn-grad w-full mt-5 py-3.5 rounded-xl text-white font-black text-sm tracking-wider"><span>Lanjut ke Ringkasan →</span></button>
      </div>

      {{-- STEP 2: Summary --}}
      <div id="step2" class="hidden">
        <div class="flex items-center gap-2 mb-5">
          <button onclick="goStep1()" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          </button>
          <div>
            <h3 class="text-white font-black text-lg">Ringkasan Pesanan</h3>
            <p class="text-gray-500 text-xs">Periksa sebelum membayar</p>
          </div>
        </div>
        <div class="bg-[#252d40] rounded-xl px-4 py-3 mb-3 flex items-center justify-between">
          <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Metode Bayar</span>
          <span id="s2-pay" class="text-cyan-400 font-bold text-sm">—</span>
        </div>
        <div class="space-y-2 mb-3 max-h-[180px] overflow-y-auto pr-1" id="s2-items"></div>
        <div class="bg-gradient-to-r from-blue-500/10 to-purple-500/10 border border-blue-500/20 rounded-xl px-4 py-4 flex items-center justify-between mb-4">
          <span class="text-gray-300 text-sm font-bold">Total Pembayaran</span>
          <span id="s2-total" class="text-blue-400 font-black text-xl">—</span>
        </div>
        <div class="mb-4">
          <label class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Email (opsional)</label>
          <input id="modal-email" type="email" placeholder="Bukti transaksi dikirim ke email"
            class="w-full bg-[#252d40] border border-white/10 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 outline-none focus:border-blue-500/50 transition-all">
        </div>
        <button onclick="confirmPayment()" class="btn-grad w-full py-3.5 rounded-xl text-white font-black text-sm tracking-wider"><span>✓ KONFIRMASI & BAYAR</span></button>
      </div>
    </div>
  </div>
</div>

<script>
function fmt(n){return'Rp '+n.toLocaleString('id-ID')}
function getCart(){return JSON.parse(localStorage.getItem('gv_cart')||'[]')}
function saveCart(c){localStorage.setItem('gv_cart',JSON.stringify(c))}
function toast(i,m){const t=document.getElementById('toast');document.getElementById('ti').textContent=i;document.getElementById('tm').textContent=m;t.classList.remove('hidden');clearTimeout(window._tt);window._tt=setTimeout(()=>t.classList.add('hidden'),3000)}

function getChecked(){
  return [...document.querySelectorAll('.item-chk:checked')].map(cb=>cb.value);
}

function updateBar(){
  const ids=getChecked();
  const cart=getCart();
  const sel=cart.filter(i=>ids.includes(i.id));
  const total=sel.reduce((s,i)=>s+i.priceNum,0);
  const count=sel.length;

  document.getElementById('bar-count').textContent=count+' item dipilih';
  document.getElementById('bar-total').textContent=fmt(total);
  document.getElementById('btn-pay').disabled=count===0;

  // Sync check-all states
  const all=document.querySelectorAll('.item-chk');
  const allChecked=all.length>0&&[...all].every(c=>c.checked);
  ['check-all','check-all-bar'].forEach(id=>{
    const el=document.getElementById(id);
    if(el){el.checked=allChecked;el.indeterminate=count>0&&!allChecked;}
  });

  // card highlight
  document.querySelectorAll('.card-item').forEach(card=>{
    const cb=card.querySelector('.item-chk');
    if(cb)card.classList.toggle('checked',cb.checked);
  });
}

function toggleAll(src){
  const val=src.checked;
  document.querySelectorAll('.item-chk').forEach(cb=>cb.checked=val);
  ['check-all','check-all-bar'].forEach(id=>{const el=document.getElementById(id);if(el)el.checked=val;});
  updateBar();
}

function removeItem(id){
  const el=document.getElementById('ci-'+id);
  if(el){el.style.transition='all .2s';el.style.opacity='0';el.style.transform='translateX(10px)';el.style.maxHeight=el.offsetHeight+'px';
    setTimeout(()=>{el.style.maxHeight='0';el.style.padding='0';el.style.margin='0';el.style.overflow='hidden';
      setTimeout(()=>{saveCart(getCart().filter(i=>i.id!==id));renderCart();toast('🗑️','Item dihapus');},200);
    },180);}
}

function deleteSelected(){
  const ids=getChecked();
  if(!ids.length){toast('⚠️','Pilih item dulu!');return;}
  saveCart(getCart().filter(i=>!ids.includes(i.id)));
  renderCart();toast('🗑️',ids.length+' item dihapus');
}

function renderCart(){
  const cart=getCart();
  const list=document.getElementById('cart-list');
  const bar=document.getElementById('bottom-bar');
  const selBar=document.getElementById('select-bar');
  const sub=document.getElementById('cart-subtitle');

  list.innerHTML='';
  sub.textContent=cart.length+' item';

  if(cart.length===0){
    bar.classList.add('hidden');selBar.classList.add('hidden');
    list.innerHTML=`<div class="flex flex-col items-center justify-center py-24 text-center">
      <div class="bounce mb-6"><svg class="w-20 h-20 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2h12l2 5v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7l2-5z"/><path d="M9 7a3 3 0 006 0"/></svg></div>
      <h2 class="text-white font-bold text-xl mb-2">Keranjang Kosong</h2>
      <p class="text-gray-500 text-sm mb-8">Belum ada item yang ditambahkan ke keranjang</p>
      <a href="{{ url('/topup/mobile-legends') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-all shadow-lg shadow-blue-600/30">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        Mulai Top Up
      </a></div>`;
    return;
  }

  bar.classList.remove('hidden');selBar.classList.remove('hidden');

  cart.forEach((item,i)=>{
    const div=document.createElement('div');
    div.id='ci-'+item.id;
    div.className='card-item fade-up bg-[#252d40]/80 backdrop-blur-md border border-white/8 rounded-2xl p-4 flex items-center gap-3';
    div.style.animationDelay=(i*.05)+'s';div.style.opacity='0';
    div.innerHTML=`
      <input type="checkbox" class="item-chk" value="${item.id}" onchange="updateBar()">
      <div class="w-12 h-12 rounded-xl flex-shrink-0 grid place-items-center font-black text-lg text-white shadow-lg" style="background:linear-gradient(135deg,${item.gameColor||'#f97316'},${item.gameColor||'#f97316'}99)">
        ${item.gameId==='ml'?'ML':item.gameId.slice(0,2).toUpperCase()}
      </div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap mb-0.5">
          <span class="text-white font-bold text-sm">${item.label}</span>
          <span class="px-2 py-0.5 rounded-full bg-blue-500/15 text-blue-400 text-[10px] font-bold border border-blue-500/20">${item.game}</span>
        </div>
        <p class="text-gray-500 text-xs">User ID: <span class="text-gray-300">${item.userId}</span> · Zone: <span class="text-gray-300">${item.zoneId}</span></p>
        <p class="text-amber-400 font-bold text-sm mt-1">${item.price}</p>
      </div>
      <button onclick="removeItem('${item.id}')" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-400 text-gray-500 flex items-center justify-center transition-all flex-shrink-0">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
      </button>`;
    list.appendChild(div);
  });

  // badge
  const badge=document.getElementById('cart-badge');
  if(badge){badge.textContent=cart.length>9?'9+':cart.length;badge.classList.remove('hidden');}
  updateBar();
}

// Modal
function openPayModal(){
  const ids=getChecked();
  if(!ids.length){toast('⚠️','Pilih item dulu!');return;}
  goStep1();
  const modal=document.getElementById('modal');
  modal.classList.remove('hidden');modal.classList.add('flex');
  document.body.style.overflow='hidden';
}
function closeModal(){
  document.getElementById('modal').classList.add('hidden');
  document.getElementById('modal').classList.remove('flex');
  document.body.style.overflow='';
}
function goStep1(){
  document.getElementById('step1').classList.remove('hidden');
  document.getElementById('step2').classList.add('hidden');
  document.getElementById('step1-dot').className='step-dot active';
  document.getElementById('step2-dot').className='step-dot inactive';
}
function goStep2(){
  const pay=document.querySelector('input[name="pay"]:checked');
  if(!pay){toast('⚠️','Pilih metode pembayaran dulu!');return;}
  const ids=getChecked();
  const cart=getCart();
  const sel=cart.filter(i=>ids.includes(i.id));
  const total=sel.reduce((s,i)=>s+i.priceNum,0);

  document.getElementById('s2-pay').textContent=pay.value;
  document.getElementById('s2-total').textContent=fmt(total);
  document.getElementById('s2-items').innerHTML=sel.map(i=>`
    <div class="bg-[#1e2433] rounded-xl px-4 py-3 flex items-center justify-between gap-3">
      <div><p class="text-white font-bold text-sm">${i.label}</p><p class="text-gray-500 text-xs">${i.game} · ID: ${i.userId} (${i.zoneId})</p></div>
      <span class="text-amber-400 font-bold text-sm flex-shrink-0">${i.price}</span>
    </div>`).join('');

  document.getElementById('step1').classList.add('hidden');
  document.getElementById('step2').classList.remove('hidden');
  document.getElementById('step1-dot').className='step-dot done';
  document.getElementById('step2-dot').className='step-dot active';
}
function confirmPayment(){
  const ids=getChecked();
  const remaining=getCart().filter(i=>!ids.includes(i.id));
  saveCart(remaining);
  closeModal();
  renderCart();
  toast('🎉','Pembayaran berhasil! Terima kasih.');
}

document.addEventListener('DOMContentLoaded',renderCart);
</script>
</body>
</html>
