const btns=[
    {
        id: 4, 
        name: '200000-500000'
    },
    {
        id: 5,
        name: '500000-800000'
    }, 
    {
        id: 4,
        name: '800000-1000000'
    },
]
const filters = [...new Set(btns.map((btn)=>
    {return btn}))]

document.getElementById('btns').innerHTML=filters.map((btn)=>{
    var {name, id} = btn;
    return(
        "<button class='fil-p' onclick='filterItems("+(id)+`)'>${name}</button>`
    )
}).join('');


const product =[
    {
        id: 1,
        image: 'canon_eos_m50.jpg',
        title: 'Canon EOS M50 Mark II Mirrorless Digital Camera with 15-45mm Lens',
        price: '244,500',
        category: 'canon camera'
    },
    {
        id: 1,
        image: 'canon_eos_r6_.jpg',
        title: 'Canon EOS R6 Mirrorless Digital Camera',
        price: '659,500',
        category: 'canon camera'
    },
    {
        id: 2,
        image: 'nikon-z5-lens.jpg',
        title: 'Nikon Z5 Mirrorless Camera with 24-50mm Lens',
        price: '499,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-fx3.jpg',
        title: 'Sony FX3 Full-Frame Cinema Camera',
        price: '1,150,000',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-fx6.jpg',
        title: 'Sony FX6 Full-Frame Cinema Camera (Body Only)',
        price: '1,799,500',
        category: 'sony'
    },
    {
        id: 1,
        image: 'canon_EOS-R.jpg',
        title: 'Canon EOS R Mirrorless Digital Camera',
        price: '512,500',
        category: 'canon camera'
    },
    {
        id: 2,
        image: 'nikon-z5-mirrorless.jpg',
        title: 'Nikon Z5 Mirrorless Camera',
        price: '359,999',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon_m200.jpg',
        title: 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens',
        price: '172,000',
        category: 'canon camera'
    },
    {
        id: 3,
        image: 'sony-a6700.jpg',
        title: 'Sony a6700 Mirrorless Camera',
        price: '469,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z5.jpg',
        title: 'Nikon Z 5 Mirrorless Digital Camera with Nikon FTZ Mount Adapter',
        price: '329,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-a6700-lens.jpg',
        title: 'Sony a6700 Mirrorless Camera with 16-50mm Lens',
        price: '515,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z6-2.jpg',
        title: 'Nikon Z 6II Mirrorless Digital Camera Body Only',
        price: '499,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon-eos-r3.jpg',
        title: 'Canon EOS R3 Mirrorless Camera',
        price: '1,649,500',
        category: 'canon'
    },
    {
        id: 1,
        image: 'canon-eos-r5.jpg',
        title: 'Canon EOS R5 Mirrorless Digital Camera',
        price: '979,500',
        category: 'canon'
    },
    {
        id: 3,
        image: 'sony-a7cr.jpg',
        title: 'Sony a7CR Mirrorless Camera',
        price: '969,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7r-4.jpg',
        title: 'Sony Alpha a7R IV Mirrorless Digital Camera (Body Only)',
        price: '929,500',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z6.jpg',
        title: 'Nikon Z 6 Mirrorless Digital Camera Body with Adapter',
        price: '345,500',
        category: 'nikon'
    },
    {
        id: 2,
        image: 'nikon-z6-lens.jpg',
        title: 'Nikon Z 6 Mirrorless Digital Camera with 24-70mm Lens',
        price: '510,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'canon-eos-r8-.jpg',
        title: 'Canon EOS R8 Mirrorless Camera',
        price: '445,500',
        category: 'canon'
    },
    {
        id: 2,
        image: 'nikon-z7-2.jpg',
        title: 'Nikon Z 7II Mirrorless Digital Camera Body Only',
        price: '749,000',
        category: 'nikon'
    },
    {
        id: 1,
        image: 'sony-a7c.jpg',
        title: 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens ',
        price: '599,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-alpha.jpg',
        title: 'Sony Alpha a1 Mirrorless Digital Camera (Body Only)',
        price: '225,0000',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z9.jpg',
        title: 'Nikon Z9 Mirrorless Camera (Body Only)',
        price: '1,639,500',
        category: 'nikon'
    },
    {
        id: 3,
        image: 'sony-zv.jpg',
        title: 'Sony ZV-E1 Mirrorless Camera with 28-60mm Lens',
        price: '839,000',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7c-2.jpg',
        title: 'Sony a7C II Mirrorless Camera',
        price: '699,500',
        category: 'sony'
    },
    {
        id: 3,
        image: 'sony-a7r-5.jpg',
        title: 'Sony a7R V Mirrorless Camera ',
        price: '900,000',
        category: 'sony'
    },
    {
        id: 2,
        image: 'nikon-z8.jpg',
        title: 'Nikon Z8 Mirrorless Camera with FTZ II Mount Adapter',
        price: '1,129,000',
        category: 'nikon'
    },
    {
        id: 2,
        image: 'nikon-z50.jpg',
        title: 'Nikon Z50 Mirrorless Camera',
        price: '229,500',
        category: 'nikon'
    },
]
const categories =[...new Set(product.map((item)=>
{return item}))]

const filterItems =(a)=>{
    const filterCategories = categories.filter(item);
    function item(value){
        if(value.id==a){
            return(
                value.id
            )
        }
    }
    displayItem(filterCategories)
}

const displayItem = (items) => {
    document.getElementById('root1').innerHTML = items.map((item)=>
    {
        var{image, title, price} = item;
        return(
            `<div class='box'>
            <h3>${title}</h3>
            <div class='img-box'>
            <img class='images' src=${image}></img>
            </div>
            <div class='bottom'>
            <h2>Rs ${price}.00</h2>
            <button>Add to cart</button>
            </div>
            </div>`)
    }).join('');
}
displayItem(categories);





